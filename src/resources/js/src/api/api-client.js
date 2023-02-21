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

    static async callPost(path, data, config = null, option = {}) {
        option = { ...{ useConvertRequest: true, useConvertResponse: true }, ...option }

        const headers = { 'Content-Type': 'multipart/form-data' };

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.post(ApiClient.baseUrl + path, reqData, { headers });
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callGet(path, data, config = {}, option = {}) {
        option = { ...{ useConvertRequest: true, useConvertResponse: true }, ...option }

        config = { ...config, ...{ data: reqData } }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.get(ApiClient.baseUrl + path, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callPut(path, data, config = {}, option = {}) {
        option = { ...{ useConvertRequest: true, useConvertResponse: true }, ...option }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.put(ApiClient.baseUrl + path, reqData, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callDelete(path, config = {}, option = {}) {
        option = { ...{ useConvertResponse: true }, ...option }

        var res = await axios.delete(ApiClient.baseUrl + path, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callPostFormData(path, data, config = null, option = {}) {
        option = { ...{ useConvertRequest: true, useConvertResponse: true }, ...option }

        config = config ? config : {}
        var headers = config.headers ? config.headers : {}
        headers = { ...headers, ...{ 'Content-Type': 'multipart/form-data' } }

        config = { ...config, headers: headers }
        return await ApiClient.callPost(path, data, config, { useConvertRequest: false })
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
        let formData = new FormData()
        formData.append('file', data)
        return await ApiClient.callPostFormData('/profiles/me/photo', formData);
    }

    // ----------------------------------------
    // kids
    // ----------------------------------------
    static async getKid() {
        var res = await ApiClient.callGet('/profiles/me/kids');

        // NOTE: 子供は3人まで
        // var kid = (res.data && res.data.kids.length > 2) ? res.data.kids[0] : null
        // res.kid = kid
        res.data = res.data.kids[0];
        // console.log(res)
        return res;
    }

    static async addKid(data) {
        return await ApiClient.callPost('/profiles/me/kids', data);
    }

    static async updateKid(id, data) {
        return await ApiClient.callPut('/profiles/me/kids/' + id, data);
    }

    static async deleteKid(id) {
        return await ApiClient.callDelete('/profiles/me/kids/' + id);
    }
}
export default ApiClient;
