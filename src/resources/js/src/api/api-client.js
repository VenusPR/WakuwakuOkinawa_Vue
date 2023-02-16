import axios from 'axios';
import camelcaseKeys from "camelcase-keys";
import snakecaseKeys from "snakecase-keys";

class ApiException extends Error {
    constructor(res, message) {
        super(message);
        this.res = res
        this.name = "ApiException";
    }
}

class ApiClient {
    static baseUrl = 'http://localhost/api' // TODO: 後で変更

    static async callPost(path, data, option = {}) {
        option = { ...{ useConvert: true }, ...option }

        var reqData = option.useConvert ? ApiClient.toRequestData(data) : data
        var res = await axios.post(ApiClient.baseUrl + path, reqData);
        if (option.useConvert) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callGet(path, data, option = {}) {
        option = { ...{ useConvert: true }, ...option }

        var reqData = option.useConvert ? ApiClient.toRequestData(data) : data
        var res = await axios.get(ApiClient.baseUrl + path, { data: reqData });
        if (option.useConvert) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callPut(path, data, option = {}) {
        option = { ...{ useConvert: true }, ...option }

        var reqData = option.useConvert ? ApiClient.toRequestData(data) : data
        var res = await axios.put(ApiClient.baseUrl + path, reqData);
        if (option.useConvert) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callDelete(path, option = {}) {
        option = { ...{ useConvert: true }, ...option }

        var res = await axios.delete(ApiClient.baseUrl + path);
        if (option.useConvert) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static isError(res) {
        return res.status >= 400;
    }

    static getApiResult(res) {
        return {
            isError: ApiClient.isError(res),
            data: res.data ? camelcaseKeys(res.data, { deep: true }) : null,
            res: res,
        }
    }

    static toRequestData(data) {
        if (data == null) return null
        return snakecaseKeys(data, { deep: true });
    }

    // ----------------------------------------
    // 以下、APIの呼び出し
    // ----------------------------------------

    // ----------------------------------------
    // bank
    // ----------------------------------------
    static async getBank() {
        var res = await ApiClient.callGet('/banks');

        // NOTE: 現在は銀行口座は１つのみ保持する
        var bank = (res.data && res.data.banks.length > 0) ? res.data.banks[0] : null
        res.data = bank
        return res;
    }

    static async addBank(data) {
        return await ApiClient.callPost('/banks', data);
    }

    static async updateBank(id, data) {
        return await ApiClient.callPut('/banks/' + id, data);
    }

    static async deleteBank(id) {
        return await ApiClient.callDelete('/banks/' + id);
    }

    // ----------------------------------------
    // profile
    // ----------------------------------------

    static async getProfile() {
        return await ApiClient.callGet('/profiles/me');
    }

    static async updateProfile(data) {
        return await ApiClient.callPut('/profiles/me', data);
    }

    static async updateProfilePhoto(data) {
        //TODO: 後で実装
        // let formData = new FormData()
        // let config = {
        //     headers: {
        //         'content-type': 'multipart/form-data',
        //     },
        // }
        // let fileData = JSON.stringify(data)
        // formData.append('file', fileData)
        // return await ApiClient.callPost('/profiles/me/image', formData, config);
    }
}
export default ApiClient;
