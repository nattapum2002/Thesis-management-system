<div>
    <form wire:submit.prevent="generatePDF">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" wire:model="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
        </div>
        <button type="submit">Generate PDF</button>
    </form>
</div>
