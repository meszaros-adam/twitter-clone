export default function (callbackFuntion) {
    window.onscroll = function () {
        if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
            callbackFuntion()
        }
    }
}