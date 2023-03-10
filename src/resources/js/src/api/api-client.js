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
        try {
            var res = await axios.post(ApiClient.baseUrl + path, reqData, config);
            return option.useConvertResponse ? ApiClient.getApiResult(res) : res;

        } catch (e) {
            console.error(e.response);
            if (e.response) {
                return option.useConvertResponse ? ApiClient.getApiResult(e.response) : e.response;
            }
            throw e;
        }
    }

    static async callGet(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        try {
            var res = await axios.get(ApiClient.baseUrl + path, { ...config, params: reqData });
            return option.useConvertResponse ? ApiClient.getApiResult(res) : res;

        } catch (e) {
            console.error(e.response);
            if (e.response) {
                return option.useConvertResponse ? ApiClient.getApiResult(e.response) : e.response;
            }
            throw e;
        }
    }

    static async callPut(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        var reqData = option.useConvertRequest ? ApiClient.toRequestData(data) : data
        try {
            var res = await axios.put(ApiClient.baseUrl + path, reqData, config);
            return option.useConvertResponse ? ApiClient.getApiResult(res) : res;

        } catch (e) {
            console.error(e.response);
            if (e.response) {
                return option.useConvertResponse ? ApiClient.getApiResult(e.response) : e.response;
            }
            throw e;
        }
    }

    static async callDelete(path, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = { ...{ headers: {} }, ...config }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        try {
            var res = await axios.delete(ApiClient.baseUrl + path, config);
            return option.useConvertResponse ? ApiClient.getApiResult(res) : res;
        } catch (e) {
            console.error(e.response);
            if (e.response) {
                return option.useConvertResponse ? ApiClient.getApiResult(e.response) : e.response;
            }
            throw e;
        }
        return res
    }

    static async callPostFormData(path, data, config = {}, option = {}) {
        option = { ...ApiClient.defaultOption, ...option }

        config = config ? config : {}
        var headers = config.headers ? config.headers : {}
        headers = { ...headers, ...{ 'Content-Type': 'multipart/form-data' } }
        config = { ...config, headers: headers }
        if (option.useAuth) {
            ApiClient.setAuthorizationHeader(config);
        }

        return await ApiClient.callPost(path, data, config, { useConvertRequest: false })
    }

    static isError(res) {
        return res.status >= 400;
    }

    static getApiResult(res) {
        if (res.status == 500) {
            return {
                isError: ApiClient.isError(res),
                data: null,
                res: res,
            }
        }
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
    static async authLogin(token) {
        return await ApiClient.callPost('/auth/login', { token: token }, { useAuth: false });
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

    // ----------------------------------------
    // kids
    // ----------------------------------------
    static async getKids() {
        return await ApiClient.callGet('/profiles/me/kids');
    }

    static async saveKids(data) {
        return await ApiClient.callPost('/profiles/me/kids', data);
    }

    static async updateKidPhoto(id, data) {
        let formData = new FormData()
        formData.append('file', data)
        return await ApiClient.callPostFormData('/profiles/me/kids/' + id + '/photo/', formData);
    }
    // ----------------------------------------
    // seniors
    // ----------------------------------------
    static async getSeniors() {
        return await ApiClient.callGet('/profiles/me/seniors');
    }
    static async saveSeniors(data) {
        return await ApiClient.callPost('/profiles/me/seniors', data);
    }
    
    static async updateSeniorPhoto(id,data) {
        let formData = new FormData()
        formData.append('file', data)
        return await ApiClient.callPostFormData('/profiles/me/seniors/' +id+'/photo/', formData);
    }
    // ----------------------------------------
    // sitter
    // ----------------------------------------
    static async getSitter() {
        return await ApiClient.callGet('/sitters/me');
    }
    static async updateSitter(data) {
        return await ApiClient.callPost('/sitters/me', data);
    }
    
}
export default ApiClient;
