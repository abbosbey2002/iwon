<!-- Backdrop Overlay -->
<div id="policyModal"  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <!-- Modal Container -->
    <div class="bg-white max-h-screen overflow-y-auto rounded-lg shadow-lg max-w-lg w-full mx-4 transform transition-all scale-95 opacity-0 duration-300">
        <!-- Modal Header -->
        <div class="flex justify-between items-center px-5 py-3 border-b">
            <h3 class="text-xl font-semibold text-gray-800">Privacy Policy</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
        </div>
        
        <!-- Modal Body (Scrollable) -->
        <div class="p-5 max-h-full overflow-y-auto text-black">
            <h1 class="text-2xl font-bold mb-4">{{ $policy?->title }}</h1>
                {!! $policy?->content !!}
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end px-5 py-3 border-t">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Close</button>
        </div>
    </div>
</div>

<!-- Modal JavaScript -->
<script>

    function openModal() {
        const modal = document.getElementById('policyModal');
        modal.classList.remove('hidden');
        setTimeout(() => modal.children[0].classList.remove('scale-95', 'opacity-0'), 10); // Animate In
    }

    function closeModal() {
        const modal = document.getElementById('policyModal');
        modal.children[0].classList.add('scale-95', 'opacity-0'); // Animate Out
        setTimeout(() => modal.classList.add('hidden'), 300);
    }
</script>
