export default {
    methods: {
        formatCurrency(value, currencySymbol) {
            return `${currencySymbol}${value.toLocaleString(undefined,
                {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        },
        getSign(value) {
            return value > 0 ? '+' : (value < 0 ? '-' : '');
        },
    },
};
