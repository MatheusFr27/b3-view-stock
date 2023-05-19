import api from '../../../plugins/axios'

export default {
    findByActionId({ commit }, actionId) {
        return new Promise(function (resolve, reject) {
            api.get(`history-action/find-by-action-id/${actionId}`).then(response => {
                commit('setHistoryActions', response.data.data);

                resolve(response.data.data)
            }).catch(error => {
                console.log(error)

                reject(error)
            })
        })
    }
}
