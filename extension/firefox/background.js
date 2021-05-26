browser.alarms.create("email-notifications", {
    delayInMinutes: 0.25,
    periodInMinutes: 0.25,
});

browser.alarms.onAlarm.addListener(() => {
    browser.storage.sync.get('last_email_id').then((lastEmailIdStorage) => {
        let last_email_id = 0;
        if ('last_email_id' in lastEmailIdStorage) {
            last_email_id = lastEmailIdStorage['last_email_id'];
        }

        fetch('https://instalogin.co/last_email', {
            credentials: 'include',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
            .then(response => response.json())
            .then((response) => {
                let lastEmailId = parseInt(response);
                if (last_email_id < lastEmailId) {
                    browser.storage.sync.set({'last_email_id': lastEmailId}, function () {});

                    browser.notifications.create({
                        "type": "basic",
                        "iconUrl": browser.extension.getURL("/48x48.png"),
                        "title": 'New email!',
                        "message": 'New email!'
                    });
                }
            });
    });
});

browser.notifications.onClicked.addListener(handleClick);

function handleClick()
{
    browser.tabs.create({
        url:"https://instalogin.co/logged_in"
    });
}