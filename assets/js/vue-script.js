var bus = new Vue({});
var routes = [
  
	{ path: '/', name: 'home' , component: HomeComponent },

	{ path: '/category', name: 'categorylist', component: CategoryListComponent },
	{ path: '/category/(index|list)', name: 'categorylist' , component: CategoryListComponent },
	{ path: '/category/(index|list)/:fieldname/:fieldvalue', name: 'categorylist' , component: CategoryListComponent , props: true },
	{ path: '/category/view/:id', name: 'categoryview' , component: CategoryViewComponent , props: true},
	{ path: '/category/view/:fieldname/:fieldvalue', name: 'categoryview' , component: CategoryViewComponent , props: true },
	{ path: '/category/add', name: 'categoryadd' , component: CategoryAddComponent },
	{ path: '/category/edit/:id' , name: 'categoryedit' , component: CategoryEditComponent , props: true},
	{ path: '/category/edit', name: 'categoryedit' , component: CategoryEditComponent , props: true},

	{ path: '/post', name: 'postlist', component: PostListComponent },
	{ path: '/post/(index|list)', name: 'postlist' , component: PostListComponent },
	{ path: '/post/(index|list)/:fieldname/:fieldvalue', name: 'postlist' , component: PostListComponent , props: true },
	{ path: '/post/view/:id', name: 'postview' , component: PostViewComponent , props: true},
	{ path: '/post/view/:fieldname/:fieldvalue', name: 'postview' , component: PostViewComponent , props: true },
	{ path: '/post/add', name: 'postadd' , component: PostAddComponent },
	{ path: '/post/edit/:id' , name: 'postedit' , component: PostEditComponent , props: true},
	{ path: '/post/edit', name: 'postedit' , component: PostEditComponent , props: true},

	{ path: '/users', name: 'userslist', component: UsersListComponent },
	{ path: '/users/(index|list)', name: 'userslist' , component: UsersListComponent },
	{ path: '/users/(index|list)/:fieldname/:fieldvalue', name: 'userslist' , component: UsersListComponent , props: true },
	{ path: '/users/view/:id', name: 'usersview' , component: UsersViewComponent , props: true},
	{ path: '/users/view/:fieldname/:fieldvalue', name: 'usersview' , component: UsersViewComponent , props: true },
	{ path: '/users/add', name: 'usersadd' , component: UsersAddComponent },
	{ path: '/users/edit/:id' , name: 'usersedit' , component: UsersEditComponent , props: true},
	{ path: '/users/edit', name: 'usersedit' , component: UsersEditComponent , props: true},

	{ path: '/home', name: 'home' , component: HomeComponent },
	{ path: '*', name: 'pagenotfound' , component: ComponentNotFound }
];

var router = new VueRouter({
	routes:routes,
	linkExactActiveClass:'active',
	linkActiveClass:'active',
	//mode:'history'
});
router.beforeEach(function(to, from, next) {
	document.body.className = to.name;
	
	next();

});
var config = {
	errorBagName: 'errors', // change if property conflicts
	fieldsBagName: 'fields', 
	delay: 0, 
	locale: '', 
	dictionary: null, 
	strict: true, 
	classes: false, 
	classNames: {
		touched: 'touched', // the control has been blurred
		untouched: 'untouched', // the control hasn't been blurred
		valid: 'valid', // model is valid
		invalid: 'invalid', // model is invalid
		pristine: 'pristine', // control has not been interacted with
		dirty: 'dirty' // control has been interacted with
	},
	events: 'input|blur',
	inject: true,
	validity: false,
	aria: true,
	i18n: null, // the vue-i18n plugin instance,
	i18nRootKey: 'validations', // the nested key under which the validation messsages will be located
};

Vue.use(VeeValidate,config);
Vue.http.interceptors.push(function(request, next) {
	next(function(response){
		if(response.status == 401 ) {
			if(this.$route.name != 'index'){
				window.location = "/"
				//this.$router.push('index');
			}
		}
		else if(response.status == 403 ) {
			alert(response.statusText);
			window.location = 'errors/forbidden';
		}
	});
});
Vue.mixin({
	data: function() {
		return {
			get ActiveUser() {
				return ActiveUser
			}
		}
	},
	methods: {
		SetPageTitle: function(title, pagename){
			document.title = title;
		},
		setPhotoUrl: function(src, width,height){
			var newSrc = 'helpers/timthumb.php?src=' + src;
			if(width){
				newSrc = newSrc + '&w=' + width
			}
			if(height){
				newSrc = newSrc + '&h=' + height	
			}
			return  newSrc;
		},
		exportPage: function(pagehtml , reporttitle){
			var form = document.getElementById("exportform");
			document.getElementById("exportformdata").value = pagehtml ;
			document.getElementById("exportformtitle").value = reporttitle ;
			form.submit();
		}
	}
});

var app = new Vue({
	el: '#app',
	router: router,
	data:{
		showPageError : false,
		pageErrorMsg : '',
		pageErrorStatus : '',
		modalComponentName: '',
		modalComponentProps: '',
		popoverTarget : '',
		showModalView : false,
		showFlash : false,
		flashMsg : '',
	},
	watch : {
		'$route': function(){
			this.pageErrorMsg = '' ;
			this.showPageError = false ;
		},
	},
	mounted : function(){
		this.$on('requestCompleted' ,  function (msg) {
			this.showModal = false;
			if(msg){
				this.showFlash = 3 ;
				this.flashMsg = msg ;
			}
			bus.$emit('refresh');
		});
		this.$on('requestError' ,  function (response) {
			this.pageErrorMsg = response.bodyText ;
			this.pageErrorStatus = response.statusText ;
			this.showPageError = true ;
		})
		
		this.$on('showPageModal' ,  function (props) {
			if(props.page){
				this.modalComponentName = props.page;
				delete props.page;
				props.resetgrid = true; // reset columns so that page components will fit well
				this.modalComponentProps = props;
				this.showModalView = true;
			}
			else{
				console.error("No Page Defined")
			}
		})
		
		this.$on('showPopOver' ,  function (props) {
			if(props.page && props.target){
				this.modalComponentName = props.page;
				this.popoverTarget = props.target;
				delete props.page;
				delete props.target;
				props.resetgrid=true;
				this.modalComponentProps = props;
			}
			else{
				console.error("No Page or Target  Defined")
			}
		})
		
		this.$on('showListModal' ,  function (arr) {
			this.modalComponentName = arr[0];
			this.modalFieldName = arr[1];
			this.modalFieldValue = arr[2];
			this.showModalList = true;
		})
	}
});


Vue.filter('toUSD', function (value) {
	return '$'+ value;
});
Vue.filter('upper', function (value) {
	return value.toUpperCase();
});
Vue.filter('lower', function (value) {
	return value.toLowerCase();
});
Vue.filter('proper', function (value) {
	return value.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
});
Vue.filter('truncate', function (text, length, suffix) {
	return text.substring(0, length) + suffix;
});
Vue.filter('toFixed', function (price, limit) {
	return price.toFixed(limit);
});
Vue.filter('makeRead', function (str) {
	return str.replace(/[-_]/g, " ");
});
Vue.filter('humanDate', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toDateString();
});
Vue.filter('humanTime', function (datestr) {
	var timeStamp = new Date(datestr);
	return timeStamp.toLocaleTimeString();
});

Vue.filter('toLocaleString', function (val) {
	return val.toLocaleString();
});
