// Vanilla ES6
if (document.querySelector('.inpsyde-table-container') ) {
    const inpsydeTableContainer = document.querySelector('.inpsyde-table-container')
    const sidebar = inpsydeTableContainer.querySelector('.sidebar-content');

    // We should use binding elements on this table, it's better than registering an event handler for every link
    const table = inpsydeTableContainer.querySelector('table')
    table.addEventListener(
        'click',
        function ( e ) {

            // Is this clicked thing, what we actually want?
            if (e.target.tagName === 'A' ) {
                // Don't open any links
                e.preventDefault();
                let userId = e.target.getAttribute('data-id');
                let httpRequest = new XMLHttpRequest();

                if (!httpRequest) {
                    return false;
                }
                httpRequest.onreadystatechange = showTheUserDetail;
                httpRequest.open('GET', info.userDetailApi + '?user-id=' + userId);
                httpRequest.setRequestHeader('Cache-Control', 'max-age=86400');
                httpRequest.send();

                function showTheUserDetail( )
                {
                    if (httpRequest.readyState === XMLHttpRequest.DONE) {
                        if (httpRequest.status === 200) {
                            sidebar.innerHTML = httpRequest.responseText;
                        } else {
                            sidebar.innerHTML = "We can't get the user info at the moment";
                        }
                    }
                }
            }
        }
    )
}

