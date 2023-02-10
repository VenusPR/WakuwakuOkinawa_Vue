import axios from 'axios';

class ApiClient {
    static baseUrl = 'http://localhost/api' // TODO: 後で変更

    static async callPost(path, data) {
        return await axios.post(ApiClient.baseUrl + path, data);
    }

    static async callGet(path, data) {
        return await axios.get(ApiClient.baseUrl + path, { data: data });
    }

    static async callPut(path, data) {
        return await axios.put(ApiClient.baseUrl + path, data);
    }

    static async callDelete(path, data) {
        return await axios.delete(ApiClient.baseUrl + path, { data: data });
    }

    static async getBank() {
        // 今現在は口座は１つのみ使用
        var res = await ApiClient.callGet('/banks');
        var banks = res.data;
        if (banks.length > 0) {
            return banks[0];
        }
        return null;
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
}
export default ApiClient;
