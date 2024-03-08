

@extends('layouts.master')
@section('content')
<h1 class="text-3xl text-black pb-6">Users</h1>

<!-- Content goes here! 😁 -->
<a href="user/create">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4">
        Add New User
    </button>
    </a>
<div class="w-full mt-12">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Users
    </p>
    <div class="bg-white overflow-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        User
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Rol
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Created at
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                <img class="w-full h-full rounded-full"
                                     src="{{ asset('profile-picture-icon-circle-member-icon-png.png') }}"
                                 alt="" />
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$user->name}}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">

                            @foreach($user->roles as $role)
                                
                            {{$role->name}}

                            @endforeach
                            
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            
                            {{$user->created_at}}
                            
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{$user->email}}
                        </p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{-- <a href="{{route('user.edit',['user'=>$user])}}">
                            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 mr-2">
                                Update
                            </button>
                            </a> --}}
                            {{-- <button 
                                class="ml-2 text-blue-500 hover:text-blue-700"
                                onclick="showEditModal({{ $user->id }})"
                            >
                                <i class="fas fa-edit"></i>
                            </button> --}}

                            <form class="" method="post" action="{{route('users.destroy',['user'=>$user])}}">
                               @csrf
                               @method('delete')
                               <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                              </button>
                            </form>
                    </td>                               
                </tr>

                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection
           

       