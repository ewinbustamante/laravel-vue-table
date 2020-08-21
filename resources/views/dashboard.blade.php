@extends('app')

@section('content')

    <div id="main" class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Laravel & Vue Table</h1>
        </div>
        <div class="col-sm-12">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="status" class="control-label col-sm-offset-6 col-sm-3">Status</label>
                    <div class="col-sm-3">
                        <select name="status" id="status" class="form-control" v-model="status" @change="getUsers()">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>NAME</td>
                        <td>EMAIL</td>
                        <td>BIO</td>
                        <td>ACTIVE</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td>@{{ user.id }}</td>
                        <td>@{{ user.name }}</td>
                        <td>@{{ user.email }}</td>
                        <td>@{{ user.bio }}</td>
                        <td class="center">
                            <input v-model="user.active" type="checkbox" class="checkbox" @change="changeActive(user)">
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="#" v-on:click.prevent="changePage(pagination.current_page - 1)">
                            <span>Prev</span>
                        </a>
                    </li>

                    <li v-for="page in pagesNumber" v-bind:class="[page === isActive ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                            @{{ page }}
                        </a>
                    </li>

                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" v-on:click.prevent="changePage(pagination.current_page + 1)">
                            <span>Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

@endsection
