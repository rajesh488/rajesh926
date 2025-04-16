const readerWrapper = document.querySelector(".reader-wrapper"),
form = document.querySelector("form"),
fileInp = form.querySelector("input"),
infoText = form.querySelector("p"),
popupBox = document.querySelector(".popup-box"),
closeBtn = document.querySelector(".close-btn"),
qrOutput = popupBox.querySelector(".qr-output");
const highlightTerms = ["Plant Name", "Scientific Name", "Uses", "Benefits", "Other Details"];
function fetchRequest(file, formData) {
infoText.innerText = "Scanning QR Code...";
fetch("http://api.qrserver.com/v1/read-qr-code/", {
    method: 'POST',
    body: formData
})
.then(res => res.json())
.then(result => {
    let qrData = result[0].symbol[0].data;
    infoText.innerText = qrData ? "Upload QR Code to Scan" : "Couldn't scan QR Code";
    if (!qrData) return;
    qrData = qrData.split('\n').map(line => {
        highlightTerms.forEach(term => {
            let regex = new RegExp(`(${term}):`, "gi");
            line = line.replace(regex, '<span class="highlight">$1:</span>');
        });
        return `<div class="qr-line"><span class="qr-text">${line}</span></div>`;
    }).join('');
    qrOutput.innerHTML = qrData;
    popupBox.classList.add("active");
})
.catch(() => {
    infoText.innerText = "Couldn't scan QR Code";
});
}
fileInp.addEventListener("change", async e => {
let file = e.target.files[0];
if (!file) return;
let formData = new FormData();
formData.append('file', file);
fetchRequest(file, formData);
});

closeBtn.addEventListener("click", () => {
popupBox.classList.remove("active");
setTimeout(() => {
    qrOutput.innerHTML = ""; 
    fileInp.value = ""; 
}, 300);
});

form.addEventListener("click", () => fileInp.click());
closeBtn.addEventListener("click", () => {
    popupBox.style.transform = "scale(0.9)";
    popupBox.style.opacity = "0";
    setTimeout(() => {
        popupBox.classList.remove("active");
        popupBox.style.transform = "scale(1)";
        popupBox.style.opacity = "1";
        qrOutput.innerHTML = ""; 
        fileInp.value = ""; 
    }, 300);
});


