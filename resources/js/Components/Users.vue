<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Table</h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" data-modal-toggle="adduser">New Add
                                        <i class="fas fa-user-plus fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Modify</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{user.id}}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.created_at}}</td>
                                        <td><span class="tag tag-success">{{user.usertype}}</span></td>
                                        <td>
                                            <a href="#">
                                                <i class="fas fa-edit blue"></i>
                                            </a>
                                            |
                                            <a href="#">
                                                <i class="fas fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <!-- Modal toggle -->
<!--                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="adduser">-->
<!--                    Toggle modal-->
<!--                </button>-->

                <!-- Main modal -->
                <div id="adduser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed  z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative w-full max-w-2xl  lg:ml-40 lg:mr-0 mr-4 h-full md:h-auto">
                        <!-- Modal content -->

                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                            <form @submit.prevent="createUser">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                                <div class="text-gray-900 dark:text-white text-lg">
                                    Add New
                                </div>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="adduser">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                            <!-- Modal body -->
<!--                            <div class="p-6 space-y-6">-->
<!--                                <input v-model="message" placeholder="edit me" />-->
<!--                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">-->
<!--                                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.-->
<!--                                </p>-->
<!--                            </div>-->

                            <div class="flex justify-center">
                                <div class="w-5/6">

                                    <div class="my-3">
<!--                                        <label for="name" class="form-label">Name</label>-->
                                        <input id="name" v-model="form.name" type="text" name="name" class="form-control" :class="{'is-invalid' : form.errors.has('name')}" placeholder="Name">
                                        <HasError :form="form" field="name" />
                                    </div>

                                    <div class="my-3">
                                        <!--                                        <label for="name" class="form-label">Name</label>-->
                                        <input id="email" v-model="form.email" type="text" name="email" class="form-control" :class="{'is-invalid' : form.errors.has('email')}" placeholder="Email Address">
                                        <HasError :form="form" field="email" />
                                    </div>

                                    <div class="my-3">
                                        <!--                                        <label for="name" class="form-label">Name</label>-->
                                        <textarea id="bio" v-model="form.bio" name="bio" class="form-control" placeholder="Short bio for user (optional)" :class="{'is-invalid' : form.errors.has('bio')}"></textarea>
                                        <HasError :form="form" field="bio" />
                                    </div>

                                    <div class="my-3">
                                        <!--                                        <label for="name" class="form-label">Name</label>-->
                                        <select id="usertype" v-model="form.usertype" type="text" name="usertype" class="form-control" :class="{'is-invalid' : form.errors.has('usertype')}" placeholder="Email Address">
                                            <option value="admin">Admin</option>
                                            <option value="user">Standard User</option>
                                            <option value="author">Author</option>
                                        </select>
                                        <HasError :form="form" field="usertype" />
                                    </div>

                                    <div class="my-3">
<!--                                        <label for="password" class="form-label">Password</label>-->
                                        <input id="password" v-model="form.password" placeholder="Password" type="password" name="password" :class="{'is-invalid' : form.errors.has('password')}" class="form-control">
                                        <HasError :form="form" field="password" />
                                    </div>

                            </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex-row  items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600 text-right ">
                                <button data-modal-toggle="adduser" type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium leading-tight uppercase rounded text-sm px-5 py-2.5 shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Decline</button>
<!--                                <button data-modal-toggle="adduser" type="button" class="text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-400 dark:hover:bg-green-600 dark:focus:ring-green-800">Create</button>-->
                                <button data-modal-toggle="adduser" type="submit" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium leading-tight uppercase text-sm px-5 py-2.5 text-center rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Create</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>





            </div>
        </div>

        </div>

</template>

<script>
import Form from "vform";

export default {
    data(){
        return {
            users:{},
            form: new Form({
                name: "",
                email: '',
                password: '',
                usertype: '',
                bio: '',
                photo: '',
            })
        }
    },
    methods:{
        loadUsers(){
          axios.get('api/user').then(res => {
              this.users = res.data.data
          });
        },
        createUser(){
            this.form.post('api/user');
        }
    },
    created() {
        this.loadUsers();
    },
    name: "Users"
}
</script>

