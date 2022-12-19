function autoComplete(inputValue) {

async function fetchAsync() {
    const response = await fetch(
        `https://www.googleapis.com/books/v1/volumes?q=rainha`
    );
    const data = await response.json();
    return data.items;
}

const printAddress = async () => {
    const a = await fetchAsync();
    return(a[0].volumeInfo.title);
};

const test = printAddress();
console.log(test);

let destination = ["spain"];
return destination.filter(
    (value) => value.toLowerCase().includes(inputValue.toLowerCase())
);

}