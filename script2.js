console.log("jalan");

function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}


domReady(function() {

    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        alert("You Qr is : " + decodeText, decodeResult);
        // console.log(decodeResult);
        console.log(decodeText);
        // $("#myModal").modal();
        window.open(decodeText, '_blank');
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader", {
            fps: 10,
            qrbos: 250
        }
    );
    htmlscanner.render(onScanSuccess);
});