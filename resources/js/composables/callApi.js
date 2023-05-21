import axios from "axios";

export default function (method, url, data) {
    try {
        return axios({
            method: method,
            url: url,
            data: data,
        })
    } catch (e) {
        return e.response
    }
}