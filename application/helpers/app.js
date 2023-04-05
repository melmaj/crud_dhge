const form = document.querySelector('form');
const inputValueUser = document.getElementById('userId');
const inputValueBook = document.getElementById('bookId');
const resultText = document.getElementById('result');
const getter = document.getElementById('getter');


form.addEventListener('submit', (event) => {
    event.preventDefault();

    const UserToSend = inputValueUser.value;
    const BookToSend = inputValueBook.value;
    const apiUrl = 'https://sxge7l8yuj.execute-api.eu-central-1.amazonaws.com/prod';

    fetch(apiUrl, {

        method: 'POST',
        body: JSON.stringify({'userId': UserToSend, 'bookId':BookToSend, 'buttonType': 'submit' })
    })
        .then(response => response.json())

        .then(data => {
            if (data.errorMessage) {
                resultText.textContent = data.errorMessage;
            } else {
                let str = `${data.body}`;
                resultText.textContent = str.replace("GMT+0000 (Coordinated Universal Time)", "");
            }
        })

        .then(data => console.log(data))
        .catch(error => console.error(error))
});

getter.addEventListener('submit', (event) => {
    event.preventDefault();

    const UserToSend = inputValueUser.value;
    const BookToSend = inputValueBook.value;
    const apiUrl = 'https://sxge7l8yuj.execute-api.eu-central-1.amazonaws.com/prod';

    fetch(apiUrl, {

        method: 'POST',
        body: JSON.stringify({'userId': UserToSend, 'bookId':BookToSend, 'buttonType': 'get' })
    })
        .then(response => response.json())

        .then(data => {
            if (data.errorMessage) {
                resultText.textContent = data.errorMessage;
            } else {
                let str = `${data.body}`;
                resultText.textContent = str.replace("GMT+0000 (Coordinated Universal Time)", "");
            }
        })

        .then(data => console.log(data))
        .catch(error => console.error(error))
});