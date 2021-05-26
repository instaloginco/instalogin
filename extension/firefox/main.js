let fillForm = document.getElementById("fillForm");

if (fillForm) {
    fillForm.addEventListener("click", async () => {
        fillForm.disabled = true;
        fillForm.innerHTML = "filling...";
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

                    for (let [field, fieldNames] of Object.entries(response['fields'])) {
                        for (let fieldName of fieldNames) {
                            try {
                                browser.tabs.executeScript({
                                    code: `
                                        document.querySelectorAll('[name=` + fieldName + `').forEach((el) => {
                                            el.value = '` + response[field] + `';
                                        })
                                    `,
                                    allFrames: true,
                                });

                                browser.tabs.executeScript({
                                    code: `
                                        document.querySelectorAll('[type=` + fieldName + `]').forEach((el) => {
                                            el.value = '` + response[field] + `';
                                        })
                                    `,
                                    allFrames: true
                                });

                                browser.tabs.executeScript({
                                    code: `
                                        document.querySelectorAll('iframe').forEach( item => {
                                            item.contentDocument.querySelectorAll('[name=` + fieldName + `]').forEach((el) => {
                                                el.value = '` + response[field] + `';
                                            });
        
                                            document.querySelectorAll('[type=` + fieldName + `]').forEach((el) => {
                                                el.value = '` + response[field] + `';
                                            });
                                        });
                                `});
                            } catch (e) {}
                        }
                    }

                } catch (e) {
                    alert(e);
                }
            } else if (req.readyState === 4 && req.status === 401) {
                fillForm.innerHTML = "LOGIN FIRST!";
                browser.tabs.create({
                    url:"https://instalogin.co/login"
                });
            }
        };
        req.open("GET", 'https://instalogin.co/profile', true); // true for asynchronous
        req.withCredentials = true;
        req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        req.send(null);
    })
}