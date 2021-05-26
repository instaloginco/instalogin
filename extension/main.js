let fillForm = document.getElementById("fillForm");

if (fillForm) {
    fillForm.addEventListener("click", async () => {
        fillForm.disabled = true;
        fillForm.innerHTML = "filling...";

        let [tab] = await chrome.tabs.query({active: true, currentWindow: true});
        var req = new XMLHttpRequest();
        req.onreadystatechange = function () {
            if (req.readyState === 4 && req.status === 200) {
                fillForm.removeAttribute("disabled");
                fillForm.innerHTML = "FILL IT!";

                try {
                    let response = JSON.parse(req.responseText);
                    document.getElementById('info').innerHTML =
                        '<hr />' +
                        'Username: ' + response['username'] + '<br />' +
                        'Password: ' + response['password'] + '<br />' +
                        'Email: ' + response['email'] + '<br />';

                    chrome.storage.sync.set({'response': response}, function () {
                        chrome.scripting.executeScript({
                            target: {tabId: tab.id},
                            files: ['fill_fields.js']
                        });
                    });
                } catch (e) {
                    alert(e);
                }
            } else if (req.readyState === 4 && req.status === 401) {
                fillForm.innerHTML = "LOGIN FIRST!";
                chrome.scripting.executeScript({
                    target: {tabId: tab.id},
                    function: () => {
                        window.open(
                            'https://instalogin.co/login',
                            '_blank'
                        );
                    }
                });
            }
        };
        req.open("GET", 'https://instalogin.co/profile', true); // true for asynchronous
        req.withCredentials = true;
        req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        req.send(null);
    })
}