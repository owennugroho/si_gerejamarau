
import { createRouter, createWebHashHistory } from 'vue-router';

import { useAuth } from 'src/composables/auth';


function passRouteToProps(route){
	return {
		queryParams: route.query,
		fieldName: route.params.fieldName, 
		fieldValue: route.params.fieldValue
	}
}


let routes = [
	//Dashboard routes


//inventaris routes
			{
				path: '/inventaris/:fieldName?/:fieldValue?',
				name: 'inventarislist',
				component: () => import('./pages/inventaris/list.vue'), 
				props: route => passRouteToProps(route)
			},
	
			{ 
				path: '/inventaris/view/:id', 
				name: 'inventarisview', 
				component: () => import('./pages/inventaris/view.vue'), 
				props: true
			},
		
			{ 
				path: '/inventaris/add', 
				name: 'inventarisadd', 
				component: () => import('./pages/inventaris/add.vue'), 
				props: true
			},
	
			{ 
				path: '/inventaris/edit/:id', 
				name: 'inventarisedit', 
				component: () => import('./pages/inventaris/edit.vue'), 
				props: true
			},
		

//jadwalturne routes
			{
				path: '/jadwalturne/:fieldName?/:fieldValue?',
				name: 'jadwalturnelist',
				component: () => import('./pages/jadwalturne/list.vue'), 
				props: route => passRouteToProps(route)
			},
	
			{ 
				path: '/jadwalturne/view/:id', 
				name: 'jadwalturneview', 
				component: () => import('./pages/jadwalturne/view.vue'), 
				props: true
			},
		
			{ 
				path: '/jadwalturne/add', 
				name: 'jadwalturneadd', 
				component: () => import('./pages/jadwalturne/add.vue'), 
				props: true
			},
	
			{ 
				path: '/jadwalturne/edit/:id', 
				name: 'jadwalturneedit', 
				component: () => import('./pages/jadwalturne/edit.vue'), 
				props: true
			},
		

//stasi routes
			{
				path: '/stasi/:fieldName?/:fieldValue?',
				name: 'stasilist',
				component: () => import('./pages/stasi/list.vue'), 
				props: route => passRouteToProps(route)
			},
	
			{ 
				path: '/stasi/view/:id', 
				name: 'stasiview', 
				component: () => import('./pages/stasi/view.vue'), 
				props: true
			},
		
			{ 
				path: '/stasi/add', 
				name: 'stasiadd', 
				component: () => import('./pages/stasi/add.vue'), 
				props: true
			},
	
			{ 
				path: '/stasi/edit/:id', 
				name: 'stasiedit', 
				component: () => import('./pages/stasi/edit.vue'), 
				props: true
			},
		

//user routes
			{
				path: '/user/:fieldName?/:fieldValue?',
				name: 'userlist',
				component: () => import('./pages/user/list.vue'), 
				props: route => passRouteToProps(route)
			},
	
			{ 
				path: '/user/view/:id', 
				name: 'userview', 
				component: () => import('./pages/user/view.vue'), 
				props: true
			},
		
			{ 
				path: '/account/edit', 
				name: 'useraccountedit', 
				component: () => import('./pages/account/accountedit.vue'), 
				props: true
			},
	
			{ 
				path: '/account', 
				name: 'useraccountview', 
				component: () => import('./pages/account/accountview.vue'), 
				props: true
			},
	
			{ 
				path: '/user/add', 
				name: 'useradd', 
				component: () => import('./pages/user/add.vue'), 
				props: true
			},
	
			{ 
				path: '/user/edit/:id', 
				name: 'useredit', 
				component: () => import('./pages/user/edit.vue'), 
				props: true
			},
		

	
	
//Password reset routes
			{ 
				path: '/index/forgotpassword', 
				name: 'forgotpassword', 
				component: () => import('./pages/index/forgotpassword.vue'), 
				props: true
			},
			{ 
				path: '/index/resetpassword', 
				name: 'resetpassword', 
				component: () => import('./pages/index/resetpassword.vue'), 
				props: true
			},
			{ 
				path: '/index/resetpassword_completed', 
				name: 'resetpassword_completed', 
				component: () => import('./pages/index/resetpassword_completed.vue'), 
				props: true
			},
	
	
	
	{ 
		path:  '/error/forbidden', 
		name: 'forbidden', 
		component: () => import('./pages/errors/forbidden.vue'),
		props: true
	},
	{ 
		path: '/error/notfound', 
		name: 'notfound',
		component: () => import('./pages/errors/pagenotfound.vue'),
		props: true
	},
	{
		path: '/:catchAll(.*)', 
		component: () => import('./pages/errors/pagenotfound.vue')
	}
];

export default () => {
	
const auth = useAuth();

	
	const user = auth.user;
	if(user){
		routes.push({ path: '/', alias: '/home', name: 'home', component: () => import(`./pages/home/home.vue`) });
	}
	else{
		routes.push({ path: '/', alias: '/index', name: 'index', component: () => import('./pages/index/index.vue') });
	}

	const router = createRouter({
		history: createWebHashHistory(),
		routes,
		scrollBehavior(to, from, savedPostion){
			if(savedPostion) return savedPostion;
			return { top:0 }
		}
	});
	
	router.beforeEach((to, from, next) => {
		const user = auth.user;
		let path = to.path;
		let authRequired = auth.pageRequiredAuth(path);
		
		//authenticate user
		if (authRequired && !user) {
			//user is not logged. redirect to login
			return next({ path: '/',  query: { nexturl: to.fullPath } });
		}

		if(user && to.name == "index"){
			//already logged in, show home when try to access index page
			return next({ path: "/home"});
		}

		//navigate to redirect url if available
		if(to.name == "home" && to.query.nexturl){
			return next({ path: to.query.nexturl});
		}

		//close dialog from previous page
		//store.dispatch('app/closeDialogs');

		//continue to specified route
		next();
	});

	return router;
}
