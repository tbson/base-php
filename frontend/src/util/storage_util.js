import { LOCAL_STORAGE_PREFIX, PROFILE_TYPE } from "src/const";

export default class StorageUtil {
    /**
     * setStorage.
     *
     * @param {string} key
     * @param {string | Dict} value
     * @returns {void}
     */
    static setStorage(key, value) {
        try {
            localStorage.setItem(
                LOCAL_STORAGE_PREFIX + "_" + key,
                JSON.stringify(value)
            );
        } catch (error) {
            console.log(error);
        }
    }

    /**
     * setStorageObj.
     *
     * @param {Object} input
     * @returns {void}
     */
    static setStorageObj(input) {
        for (const key in input) {
            const value = input[key];
            StorageUtil.setStorage(key, value);
        }
    }

    /**
     * getStorageObj.
     *
     * @param {string} key
     * @returns {Object}
     */
    static getStorageObj(key) {
        try {
            const value = StorageUtil.parseJson(
                localStorage.getItem(LOCAL_STORAGE_PREFIX + "_" + key)
            );
            if (value && typeof value === "object") {
                return value;
            }
            return {};
        } catch (error) {
            console.log(error);
            return {};
        }
    }

    /**
     * getStorageStr.
     *
     * @param {string} key
     * @returns {string}
     */
    static getStorageStr(key) {
        try {
            const value = StorageUtil.parseJson(
                localStorage.getItem(LOCAL_STORAGE_PREFIX + "_" + key)
            );
            if (!value || typeof value === "object") {
                return "";
            }
            return String(value);
        } catch (error) {
            return "";
        }
    }

    /**
     * getToken.
     *
     * @returns {string}
     */
    static getToken() {
        const authObj = StorageUtil.getStorageObj("auth");
        return authObj.access_token || "";
    }

    /**
     * setAuthData.
     *
     * @param {Object} authObj
     * @returns {void}
     */
    static setAuthData(authData) {
        StorageUtil.setStorage("auth", authData);
    }

    /**
     * setToken.
     *
     * @param {string} token
     * @returns {void}
     */
    static setToken(token) {
        const authData = StorageUtil.getStorageObj("auth");
        authData["access_token"] = token;
        StorageUtil.setStorage("auth", authData);
    }

    /**
     * getProfileType.
     *
     * @returns {string}
     */
    static getProfileType() {
        const authObj = StorageUtil.getStorageObj("auth");
        return authObj.user.profile_type || "";
    }

    /**
     * getAuthUser.
     *
     * @returns {number}
     */
    static getAuthUser() {
        const authObj = StorageUtil.getStorageObj("auth");
        return authObj.user;
    }

    /**
     * removeStorage.
     *
     * @param {string} key
     * @returns {void}
     */
    static removeStorage(key) {
        localStorage.removeItem(LOCAL_STORAGE_PREFIX + "_" + key);
    }

    /**
     * parseJson.
     *
     * @param {string} input
     * @returns {string}
     */
    static parseJson(input) {
        try {
            return JSON.parse(input);
        } catch (error) {
            return String(input);
        }
    }

    /**
     * getVisibleMenus.
     *
     * @returns {string[]}
     */
    static getVisibleMenus() {
        const authObj = StorageUtil.getStorageObj("auth");
        return authObj.visible_menus || [];
    }

    /**
     * getPems.
     *
     * @returns {string[]}
     */
    static getPems() {
        const authObj = StorageUtil.getStorageObj("auth");
        return authObj.pems || {};
    }

    /**
     * isAdminSide.
     *
     * @param {number} profileType
     * @returns {boolean}
     */
    static isAdminSide(profileType) {
        return [PROFILE_TYPE.admin, PROFILE_TYPE.staff].includes(profileType);
    }

    /**
     * isCustomerSide.
     *
     * @param {number} profileType
     * @returns {boolean}
     */
    static isCustomerSide(profileType) {
        return [PROFILE_TYPE.assistant, PROFILE_TYPE.director].includes(profileType);
    }
}
