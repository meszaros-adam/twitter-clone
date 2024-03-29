import axios from "axios";

export default async function (method, url, data) {
    try {
        return await axios({
            method: method,
            url: url,
            data: data,
        })
    } catch (e) {
        console.log(e)
        return e.response
    }
}