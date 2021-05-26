<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Models\UserEmail;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use PhpMimeMailParser\Parser;

class ProcessEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process_email:store {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process email on retrieval';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = base64_decode($this->argument('file'));

        $parser = new Parser();
        $parser->setText($file);

        try {
            preg_match('/score=(.*?) /', $parser->getHeader('X-Spam-Status'), $match);
            $spamScore = (float) $match[1];
        } catch (\Exception $e) {
            $spamScore = 0;
        }

        if ($spamScore < 5) {
            $to = $parser->getHeader('To');

            $userEmail = UserEmail::where(['email' => $to])->exists();

            echo $parser->getHeader('From') . ' sent an email. ';

            if (!$userEmail) {
                preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $to, $matches);
                $to = $matches[0][0];
                $userEmail = UserEmail::where(['email' => $to])->exists();
            }

            if ($userEmail) {
                Email::create([
                    'recipient' => $to,
                    'sender' => $parser->getHeader('From'),
                    'subject' => $parser->getHeader('Subject'),
                    'date' => Carbon::parse($parser->getHeader('Date'))->setTimezone('UTC'),
                    'body' => $parser->getMessageBody('html')
                ]);

                $this->visitLinksInBody($parser->getMessageBody('html'));

            } else {
                echo $to . ' does not exist. ';
            }
        }
    }

    protected function visitLinksInBody($body)
    {
        $dom = new DOMDocument;

        //Parse the HTML. The @ is used to suppress any parsing errors
        //that will be thrown if the $html string isn't valid XHTML.
        @$dom->loadHTML($body);

        //Get all links. You could also use any other tag name here,
        //like 'img' or 'table', to extract other tags.
        $links = $dom->getElementsByTagName('a');

        //Iterate over the extracted links and display their URLs
        $i = 1;
        foreach ($links as $link) {
            shell_exec('curl ' . $link->getAttribute('href'));
            $i++;
            if ($i > 8) break;
        }
    }
}
