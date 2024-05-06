import { createStore, createLogger } from 'vuex';
import dashboard from "./modules/dashboard";
export default createStore({
        modules: {
            dashboard,
        }
    }
)
