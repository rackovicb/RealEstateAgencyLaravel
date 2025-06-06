document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const estateId = this.dataset.id;
            const btn = this;

            fetch("/favorites/toggle", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    real_estate_id: estateId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    btn.closest('.property-card').remove();
                } else {
                    btn.innerText = 'Remove from Favorites';
                    btn.classList.remove('bg-blue-500');
                    btn.classList.add('bg-red-500');
                }
            });
        });
    });
});
