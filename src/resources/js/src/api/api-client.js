import { storage } from '@/utils/storage';
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
    static baseUrl = 'http://localhost/api'; // TODO: 後で変更

    static async setAuthorizationHeader(config) {
        var token = storage.getUserToken();
        config.headers['Authorization'] = 'Bearer ' + token;
    }

    static defaultOption = { useConvertRequest: true, useConvertResponse: true, useAuth: true };

    static async callPost(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.post(ApiClient.baseUrl + path, reqData, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callGet(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.get(ApiClient.baseUrl + path, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callPut(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        var res = await axios.put(ApiClient.baseUrl + path, reqData, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callDelete(path, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var res = await axios.delete(ApiClient.baseUrl + path, config);
        if (option.useConvertResponse) {
            return ApiClient.getApiResult(res)
        }
        return res
    }

    static async callPostFormData(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = config ? config : {}
        var headers = config.headers ? config.headers : {}
        headers = { ...headers, ...{ 'Content-Type': 'multipart/form-data' } }

        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(headers);
        }

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
    // auth
    // ----------------------------------------
    static async authVerify(token) {
        return await ApiClient.callPost('/auth/verify', { token: token }, { useAuth: false });
    }

    static async getAuthUser() {
        return await ApiClient.callGet('/auth/user');
    }

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
}
export default ApiClient;
