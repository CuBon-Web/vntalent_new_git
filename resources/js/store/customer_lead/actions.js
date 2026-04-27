import { HTTP } from '../../core/plugins/http';

export const listCustomerLeads = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/customer-leads/list', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const detailCustomerLead = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/customer-leads/detail/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const deleteCustomerLead = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/customer-leads/delete/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
