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
        // alert("You Qr is : " + decodeText, decodeResult);
        // console.log(decodeResult);   
        console.log(decodeText);
        let receiver = "";
        try {
            let url = new URLSearchParams(decodeText);
            receiver = url.get("receiver");
            console.log(receiver);
        }
        catch (error) {
            console.log("error");
        }
        $("#sender").val(currentUser);
        $("#receiver").val(receiver);
        $("#myModal").modal();
        // window.open(decodeText, '_blank');
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader", {
            fps: 10,
            qrbos: 250
        }
    );
    htmlscanner.render(onScanSuccess);
});