    <template id="postView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Post</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div v-show="!loading">
                                    <div ref="datatable" id="datatable">
                                        <table class="table table-hover table-borderless table-striped">
                                            <!-- Table Body Start -->
                                            <tbody>
                                                <tr>
                                                    <th class="title"> Id :</th>
                                                    <td class="value"> {{ data.id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Headline :</th>
                                                    <td class="value"> {{ data.headline }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Title :</th>
                                                    <td class="value"> {{ data.title }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Category :</th>
                                                    <td class="value"> {{ data.category }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Content :</th>
                                                    <td class="value"> {{ data.content }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Author :</th>
                                                    <td class="value"> {{ data.author }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/post/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/post/delete/' + data.id">
                                            <i class="fa fa-times"></i> </button>
                                        </span>
                                        <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                            <i class="fa fa-save"></i> 
                                        </button>
                                    </div>
                                </div>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var PostViewComponent = Vue.component('postView', {
		template : '#postView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'post',
			},
			routename : {
				type : String,
				default : 'postview',
			},
			apipath: {
				type : String,
				default : 'post/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',headline: '',title: '',category: '',content: '',author: '',status: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Post';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',headline: '',title: '',category: '',content: '',author: '',status: '',
				}
			},
		},
	});
	</script>
