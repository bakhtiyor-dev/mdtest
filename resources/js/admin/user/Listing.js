import AppListing from '../app-components/Listing/AppListing';

Vue.component('user-listing', {
    mixins: [AppListing],
    data() {
        return {
            loading: false
        }
    },
    methods: {
        sync() {
            this.loading = true;
	    //this.$Progress.start();	
            axios.create().get('/admin/users/sync').then((response) => {
                this.loadData();
                this.loading = false;
		//this.$Progress.finish();
		this.$notify({
			type:'success',
			duration:5000,
			title:'Успех',
			text: response.data.message
		}).catch((error) => {
			this.loading = false;
			//this.$Progress.fail();
			this.$notify({
				type: 'error',
				duration: -1,
				title: 'Ошибка!',
				text:  error.response.data.message
			});
		});
            });
        }
    }
});
