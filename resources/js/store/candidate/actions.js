import { HTTP } from "../../core/plugins/http";

export const addCandidate = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post("/api/candidate/create", opt)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const listCandidate = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.post("/api/candidate/list", opt)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const deleteCandidate = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get("/api/candidate/delete/" + opt.id)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};

export const detailCandidate = ({ commit }, opt) => {
  return new Promise((resolve, reject) => {
    HTTP.get("/api/candidate/edit/" + opt.id)
      .then((response) => {
        return resolve(response.data);
      })
      .catch((error) => {
        return reject(error);
      });
  });
};
