    <template id="postEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Post</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'post/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('headline')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="headline">Headline <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.headline"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Headline"
                                                    class="form-control "
                                                    type="text"
                                                    name="headline"
                                                    placeholder="Enter Headline"
                                                    />
                                                    <small v-show="errors.has('headline')" class="form-text text-danger">
                                                        {{ errors.first('headline') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('title')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.title"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Title"
                                                    class="form-control "
                                                    type="text"
                                                    name="title"
                                                    placeholder="Enter Title"
                                                    />
                                                    <small v-show="errors.has('title')" class="form-text text-danger">
                                                        {{ errors.first('title') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('category')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="category">Category <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.category"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Category"
                                                    class="form-control "
                                                    type="text"
                                                    name="category"
                                                    placeholder="Enter Category"
                                                    />
                                                    <small v-show="errors.has('category')" class="form-text text-danger">
                                                        {{ errors.first('category') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('content')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="content">Content <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.content"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Content"
                                                    class="form-control "
                                                    type="text"
                                                    name="content"
                                                    placeholder="Enter Content"
                                                    />
                                                    <small v-show="errors.has('content')" class="form-text text-danger">
                                                        {{ errors.first('content') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('author')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="author">Author <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.author"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Author"
                                                    class="form-control "
                                                    type="text"
                                                    name="author"
                                                    placeholder="Enter Author"
                                                    />
                                                    <small v-show="errors.has('author')" class="form-text text-danger">
                                                        {{ errors.first('author') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('status')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.status"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Status"
                                                    class="form-control "
                                                    type="text"
                                                    name="status"
                                                    placeholder="Enter Status"
                                                    />
                                                    <small v-show="errors.has('status')" class="form-text text-danger">
                                                        {{ errors.first('status') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
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
	var PostEditComponent = Vue.component('postEdit', {
		template : '#postEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'post',
			},
			routename : {
				type : String,
				default : 'postedit',
			},
			apipath : {
				type : String,
				default : 'post/edit',
			},
		},
		data: function() {
			return {
				data : { headline: '',title: '',category: '',content: '',author: '',status: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Post';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/post');
				}
			},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>
