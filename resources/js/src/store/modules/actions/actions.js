import api from '../../../plugins/axios'

export default {
    initialize({ commit }) {
        return new Promise(function (resolve, reject) {
            api.get('action/initialize').then(response => {
                commit('setActions', response.data.data);

                resolve(response.data.data)
            }).catch(error => {
                console.log(error)

                reject(error)
            })
        })
    }
}
