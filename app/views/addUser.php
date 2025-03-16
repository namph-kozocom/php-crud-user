<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Add User</title>
</head>

<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8">
            <h3 class="text-gray-700 text-3xl font-medium">Add New User</h3>
            <div class="mt-6 bg-white shadow-md rounded-lg p-6">
                <form action="/save-user" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="firstName" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="lastName" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" required class="mt-1 p-2 w-full border rounded-md">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="mt-1 p-2 w-full border rounded-md">
                            <img id="preview" class="max-w-[200px] object-cover rounded my-2 hidden">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="/" class="bg-gray-500 px-4 py-2 rounded text-white mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-500 px-4 py-2 rounded text-white">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</html>