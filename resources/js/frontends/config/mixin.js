Vue.mixin({
    data: function () {
        return {
        };
    },
    created: function () {
    },
    methods: {
        baseUrl: function (path) {
            if (path && path.toString().slice(0, 1) == '/') {
                return BASE_URL + path;
            }

            return BASE_URL + '/' + path;
        },
        strToJson: function (str) {
            return JSON.parse(str);
        },
    },
});