export default function (callbackFuntion) {
    window.onscroll = function () {
        if (Math.ceil(window.scrollY + window.innerHeight) >= document.documentElement.scrollHeight) {
            callbackFuntion()
        }
    }
}