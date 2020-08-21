
new Vue({
    el: '#main',
    created: function () {
        this.getUsers();
    },
    data: {
        users: [],
        status: '',
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0,
        },
        offset: 5
    },
    computed: {
        isActive() {
            return this.pagination.current_page;
        },
        pagesNumber() {
            if (!this.pagination.to) {
                return [];
            }

            let from = this.pagination.current_page - this.offset;

            if (from < 1) {
                from = 1;
            }

            let to = from + (this.offset * 2);

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            let pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    },
    methods: {
        getUsers(page) {
            let urlUsers = 'users?status='+this.status+'&page='+page;
            axios.get(urlUsers)
                .then(response => {
                    this.users = response.data.users.data;
                    this.pagination = response.data.pagination;
                });
        },
        changeActive(user) {
            let url = 'users/change_active/' + user.id
            axios.post(url)
                .then(response => {
                    this.getUsers();
                    toastr.success('Status changed successfully');
                }).catch(error => {

                });
        },
        changePage(page) {
            this.pagination.current_page = page;
            this.getUsers(page);
        }
    }
});
