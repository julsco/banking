export default {
    methods: {
        formatCurrency(value, currencySymbol) {
            return `${currencySymbol}${value.toLocaleString(undefined,
                {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        },
        getSign(value) {
            return value > 0 ? '+' : (value < 0 ? '-' : '');
        },
        formatDateWithDay(date) {
            const options = { weekday: 'short', day: 'numeric', month: 'short' };
            return new Date(date).toLocaleDateString('en-US', options);
        }
    },
};
