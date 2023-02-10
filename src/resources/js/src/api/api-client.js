import axios from 'axios';

class ApiClient {
    baseUrl = 'http://localhost' // TODO: 後で変更

    async callPost(path, data) {
        return await axios.post(baseUrl + path, data);
    }

    async callGet(path, data) {
        return await axios.get(this.baseUrl + path, data);
    }

    async callPut(path, data) {
        return await axios.put(this.baseUrl + path, data);
    }

    async callDelete(path, data) {
        return await axios.delete(this.baseUrl + path, data);
    }

    async getBank() {
        return await this.callGet('/banks');
    }

    async addBank(data) {
        return await this.callPost('/banks', data);
    }

    async updateBank(data) {
        return await this.callPost('/banks', data);
    }

    async deleteBank(id) {
        return await this.callDelete('/banks/' + id);
    }
}
