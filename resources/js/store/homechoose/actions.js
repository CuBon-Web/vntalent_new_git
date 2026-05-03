import { HTTP } from '../../core/plugins/http';

export const addHomeChoose = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post('/api/createHomeChoose', opt)
      .then((response) => resolve(response.data))
      .catch((error) => reject(error));
  });
};

export const listHomeChoose = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post('/api/listHomeChoose', opt || {})
      .then((response) => resolve(response.data))
      .catch((error) => reject(error));
  });
};

export const deleteHomeChoose = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get('/api/deleteHomeChoose/' + opt.id)
      .then((response) => resolve(response.data))
      .catch((error) => reject(error));
  });
};

export const detailHomeChoose = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get('/api/editHomeChoose/' + opt.id)
      .then((response) => resolve(response.data))
      .catch((error) => reject(error));
  });
};
