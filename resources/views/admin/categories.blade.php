@extends('layouts.master')

@section('content')
    <div class="container mx-auto my-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Categories</h2>
            <button 
                class="bg-blue-500 text-white px-4 py-2 rounded focus:outline-none focus:shadow-outline-blue"
                onclick="showAddModal()"
            >
                Add new category
            </button>
        </div>
        
        <!-- Table -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Category's name</th>
                    <th class="py-2 px-4 border-b">Created at</th>
                    <th class="py-2 px-4 border-b">Updated at</th>
                    <th class="py-2 px-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through categories and populate the table -->
                @foreach($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->created_at }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->updated_at }}</td>
                        <td class="py-2 px-4 border-b">
                            {{-- <button 
                                class="text-red-500 hover:text-red-700"
                                onclick="showDeleteModal({{ $category->id }})"
                            > --}}
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class=" text-red-500 hover:text-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button 
                                class="ml-2 text-blue-500 hover:text-blue-700"
                                onclick="showEditModal({{ $category->id }}, '{{ $category->name }}')"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div id="addModal" class="hidden z-50 ">
        <!-- Modal Content -->
        <div class="bg-white p-8 w-1/2 mx-auto mt-10">
            <h2 class="text-2xl font-semibold mb-4">Add New Category</h2>
            <!-- Form to add a new category -->
            <form action="{{ route('categories.store') }}" method="post">
                @csrf
                <label for="name" class="block text-sm font-medium text-gray-600">Category Name</label>
                <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
                <button 
                    type="submit" 
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded focus:outline-none focus:shadow-outline-blue"
                >
                    Add Category
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div id="deleteModal" class="hidden">
        <!-- Modal Content -->
        <div class="bg-white p-8 w-1/3 mx-auto mt-10">
            <h2 class="text-2xl font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-4">Do you really want to delete this category?</p>
            <form action="{{ route('categories.destroy', ['category' => $category]) }}" method="post">
                @csrf
                @method('delete')
            
                <button 
                class="bg-red-500 text-white px-4 py-2 rounded focus:outline-none focus:shadow-outline-red"
                onclick="deleteCategory()"
                >
                Yes, Delete
               </button>
             </form>
            <button 
                class="ml-4 border border-gray-300 px-4 py-2 rounded focus:outline-none focus:shadow-outline-gray"
                onclick="closeDeleteModal()"
            >
                Cancel
            </button>
        </div>
    </div>

{{-- delit modal flobit --}}
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <form action="{{ route('categories.destroy', ['category' => $category]) }}" method="post">
                        @csrf
                        @method('delete')
                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                   </form>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editModal" class="hidden"> 
        <!-- Modal Content -->
        <div class="bg-white p-8 w-1/2 mx-auto mt-10">
            <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>
            <!-- Form to edit a category -->
            <form action="{{ route('categories.update', ['category' => $category]) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="category_id" id="editCategoryId">
                <label for="editName" class="block text-sm font-medium text-gray-600">Category Name</label>
                <input type="text" name="name" id="editName" class="form-input mt-1 block w-full" required>
                <button 
                    type="submit" 
                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded focus:outline-none focus:shadow-outline-blue"
                >
                    Save Changes
                </button>
            </form>
        </div>
    </div>

    <script>
        function showAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function showDeleteModal(categoryId) {
            document.getElementById('deleteModal').classList.remove('hidden');
            // You might want to set categoryId in a hidden input for reference in the deleteCategory function.
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function deleteCategory() {
            // Implement the logic to delete the category using AJAX or a form submission.
        }

        function showEditModal(categoryId, categoryName) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editCategoryId').value = categoryId;
            document.getElementById('editName').value = categoryName;
        }
    </script>
@endsection
