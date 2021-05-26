
chrome.storage.sync.get(['response'], function(response) {
    response = response['response'];
    for (let [field, fieldNames] of Object.entries(response['fields'])) {
        for (let fieldName of fieldNames) {
            try {
                document.querySelectorAll('[name=' + fieldName + ']').forEach((el) => {
                    el.value = response[field];
                });

                document.querySelectorAll('[type=' + fieldName + ']').forEach((el) => {
                    el.value = response[field];
                });

                document.querySelectorAll('iframe').forEach( item => {
                    item.contentDocument.querySelectorAll('[name=' + fieldName + ']').forEach((el) => {
                        el.value = response[field];
                    });

                    document.querySelectorAll('[type=' + fieldName + ']').forEach((el) => {
                        el.value = response[field];
                    });
                });

            } catch (e) {}
        }
    }
});
