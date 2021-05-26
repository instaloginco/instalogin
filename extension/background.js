chrome.alarms.create({ delayInMinutes: 0.25, periodInMinutes: 0.25 });

chrome.alarms.onAlarm.addListener(() => {
    chrome.storage.sync.get(['last_email_id'], function(response) {
        let lastEmailIdStorage = 0;
        if ('last_email_id' in response) {
            lastEmailIdStorage = parseInt(response.last_email_id);
        }
        fetch('https://instalogin.co/last_email', {
            credentials: 'include',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        })
            .then(response => response.json())
            .then((response) => {
            let lastEmailId = parseInt(response);
            if (lastEmailIdStorage < lastEmailId) {
                chrome.storage.sync.set({'last_email_id': lastEmailId}, function () {});

                let notificationObject = registration.showNotification('InstaLogin.co', {
                    body: 'New Email!',
                    data: { url: 'https://instalogin.co' },
                });

                // Notification click event listener
                self.addEventListener('notificationclick', e => {
                    // Close the notification popout
                    e.notification.close();
                    // Get all the Window clients
                    e.waitUntil(clients.matchAll({ type: 'window' }).then(clientsArr => {
                        // If a Window tab matching the targeted URL already exists, focus that;
                        const hadWindowToFocus = clientsArr.some(windowClient => windowClient.url === e.notification.data.url ? (windowClient.focus(), true) : false);
                        // Otherwise, open a new tab to the applicable URL and focus it.
                        if (!hadWindowToFocus) clients.openWindow(e.notification.data.url).then(windowClient => windowClient ? windowClient.focus() : null);
                    }));
                });
            }
        });

    });
});