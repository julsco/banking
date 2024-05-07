import { createStore, createLogger } from 'vuex';
import dashboard from "./modules/dashboard";
import userVariables from "./modules/user-variables";

export default createStore({
        modules: {
            userVariables,
            dashboard,
        }
    }
)
