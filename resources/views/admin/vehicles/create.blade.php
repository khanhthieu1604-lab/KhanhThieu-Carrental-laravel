@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Thêm xe mới</h2>
                <p class="mt-1 text-sm text-gray-600">Nhập thông tin chi tiết để đưa xe vào hệ thống cho thuê.</p>
            </div>
            <a href="{{ route('admin.vehicles.index') }}" class="group flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 transition">
                <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-2 group-hover:border-gray-400 group-hover:shadow-sm transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                Quay lại danh sách
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Thông tin chung</h3>
                            <p class="text-xs text-gray-500">Các thông tin cơ bản về phương tiện.</p>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Tên xe <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required placeholder="Ví dụ: Mazda CX-5 2024 Premium" 
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 transition placeholder-gray-400 text-sm">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Hãng sản xuất <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="brand" id="brand" required 
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 appearance-none transition text-sm">
                                        <option value="" disabled selected>-- Chọn hãng --</option>
                                        <option value="Toyota">Toyota</option>
                                        <option value="Honda">Honda</option>
                                        <option value="Mazda">Mazda</option>
                                        <option value="Hyundai">Hyundai</option>
                                        <option value="Kia">Kia</option>
                                        <option value="Mercedes">Mercedes</option>
                                        <option value="BMW">BMW</option>
                                        <option value="VinFast">VinFast</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <i class="fa-solid fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="rent_price_per_day" class="block text-sm font-medium text-gray-700 mb-1">Giá thuê (ngày) <span class="text-red-500">*</span></label>
                                <div class="relative rounded-xl shadow-sm">
                                    <input type="number" name="rent_price_per_day" id="rent_price_per_day" required placeholder="0" 
                                        class="w-full rounded-xl border-gray-300 pl-4 pr-16 py-3 focus:border-blue-500 focus:ring-blue-500 transition text-sm font-semibold text-gray-900">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm font-bold bg-gray-100 px-2 py-1 rounded">VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Mô tả chi tiết</label>
                            <textarea name="description" id="description" rows="5" placeholder="Mô tả về tình trạng xe, tính năng nổi bật, nội thất..."
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 transition text-sm placeholder-gray-400"></textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-gray-100 pb-4 mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Hình ảnh</h3>
                            <p class="text-xs text-gray-500">Ảnh đại diện cho xe (JPG, PNG).</p>
                        </div>

                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh xe</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-blue-500 hover:bg-blue-50/30 transition group cursor-pointer relative">
                                <div class="space-y-1 text-center">
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition group-hover:bg-blue-100">
                                        <i class="fa-regular fa-image text-xl text-gray-400 group-hover:text-blue-600"></i>
                                    </div>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                            <span>Tải ảnh lên</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG tối đa 5MB</p>
                                </div>
                                </div>
                        </div>

                        <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fa-solid fa-circle-info text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Trạng thái mặc định</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Xe mới thêm sẽ có trạng thái là <span class="font-bold">"Sẵn sàng"</span> để khách hàng có thể thuê ngay lập tức.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button type="reset" class="px-6 py-3 bg-white border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        Làm mới
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gray-900 border border-transparent rounded-xl text-sm font-bold text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition flex items-center">
                        <i class="fa-solid fa-check mr-2"></i> Lưu xe mới
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        
        const reader = new FileReader();
        reader.onload = function(){
            
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection