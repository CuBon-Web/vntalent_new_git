import { HTTP } from "../../core/plugins/http";

export const listCandidateCategory = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post("/api/candidate/category/list", opt)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const addCandidateCategory = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post("/api/candidate/category/create", opt)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const detailCandidateCategory = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get("/api/candidate/category/edit/" + opt.id)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const deleteCandidateCategory = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get("/api/candidate/category/delete/" + opt.id)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};
