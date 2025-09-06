// Student Applications JavaScript with Event Delegation
// This works with dynamically loaded content (sidebar navigation)

class StudentApplicationManager {
    constructor() {
        this.selectedProgrammes = new Map();
        this.maxApplications = 2;
        this.init();
    }

    init() {
        this.attachEventListeners();
        this.updateSelectedDisplay();
    }

    attachEventListeners() {
        // Use event delegation - attach to document body
        document.body.addEventListener('click', (e) => {
            // Apply button clicks
            if (e.target.matches('.apply-btn')) {
                this.handleApplyClick(e.target);
            }
            
            // Submit applications button
            if (e.target.matches('#submit-applications')) {
                this.handleSubmitClick();
            }
            
            // Modal cancel button
            if (e.target.matches('#cancel-application')) {
                this.hideModal();
            }
            
            // Modal confirm button
            if (e.target.matches('#confirm-application')) {
                this.confirmApplication();
            }
            
            // Modal backdrop click
            if (e.target.matches('#confirmation-modal')) {
                this.hideModal();
            }
        });

        // Handle page refresh/navigation - reinitialize when needed
        document.addEventListener('DOMContentLoaded', () => {
            this.reinitialize();
        });

        // For Livewire compatibility
        document.addEventListener('livewire:navigated', () => {
            this.reinitialize();
        });
    }

    reinitialize() {
        // Reset state when page content changes
        this.selectedProgrammes.clear();
        this.updateSelectedDisplay();
    }

    handleApplyClick(button) {
        const programmeId = button.dataset.programmeId;
        const programmeName = button.dataset.programmeName;
        const school = button.dataset.school;
        
        if (this.selectedProgrammes.has(programmeId)) {
            // Remove programme
            this.selectedProgrammes.delete(programmeId);
            button.textContent = 'Apply for this Programme';
            button.classList.remove('bg-red-600', 'hover:bg-red-700');
            
            // Restore original color based on section
            if (button.closest('.bg-white')?.querySelector('.bg-green-100')) {
                button.classList.add('bg-green-600', 'hover:bg-green-700');
            } else {
                button.classList.add('bg-yellow-600', 'hover:bg-yellow-700');
            }
        } else {
            // Add programme
            if (this.selectedProgrammes.size >= this.maxApplications) {
                alert(`You can only select ${this.maxApplications} programmes maximum.`);
                return;
            }
            
            this.selectedProgrammes.set(programmeId, {
                name: programmeName,
                school: school
            });
            button.textContent = 'Remove from Selection';
            button.classList.remove('bg-green-600', 'hover:bg-green-700', 'bg-yellow-600', 'hover:bg-yellow-700');
            button.classList.add('bg-red-600', 'hover:bg-red-700');
        }
        
        this.updateSelectedDisplay();
    }

    updateSelectedDisplay() {
        const selectedSection = document.getElementById('selected-programmes');
        const noSelectionSection = document.getElementById('no-selection');
        const programmeListDiv = document.getElementById('programme-list');
        
        if (!selectedSection || !noSelectionSection || !programmeListDiv) {
            return; // Elements not found, probably on different page
        }

        if (this.selectedProgrammes.size === 0) {
            selectedSection.classList.add('hidden');
            noSelectionSection.classList.remove('hidden');
        } else {
            selectedSection.classList.remove('hidden');
            noSelectionSection.classList.add('hidden');
            
            programmeListDiv.innerHTML = '';
            let index = 1;
            this.selectedProgrammes.forEach((programme, id) => {
                const div = document.createElement('div');
                div.className = 'text-sm bg-white/20 rounded p-2';
                div.innerHTML = `
                    <span class="font-medium">${index === 1 ? '1st' : '2nd'} Choice:</span>
                    ${programme.name} (${programme.school} School)
                `;
                programmeListDiv.appendChild(div);
                index++;
            });
        }
    }

    handleSubmitClick() {
        if (this.selectedProgrammes.size === 0) {
            alert('Please select at least one programme.');
            return;
        }
        
        this.showModal();
    }

    showModal() {
        const modal = document.getElementById('confirmation-modal');
        const modalProgrammeList = document.getElementById('modal-programme-list');
        
        if (!modal || !modalProgrammeList) return;

        // Update modal with selected programmes
        modalProgrammeList.innerHTML = '';
        let index = 1;
        this.selectedProgrammes.forEach((programme, id) => {
            const div = document.createElement('div');
            div.className = 'text-sm mb-1';
            div.innerHTML = `<span class="font-medium">${index === 1 ? '1st' : '2nd'} Choice:</span> ${programme.name} (${programme.school} School)`;
            modalProgrammeList.appendChild(div);
            index++;
        });
        
        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    hideModal() {
        const modal = document.getElementById('confirmation-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    confirmApplication() {
        const form = document.getElementById('application-form');
        const programmeInputsDiv = document.getElementById('programme-inputs');
        
        if (!form || !programmeInputsDiv) return;

        // Prepare form
        programmeInputsDiv.innerHTML = '';
        this.selectedProgrammes.forEach((programme, id) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'programmes[]';
            input.value = id;
            programmeInputsDiv.appendChild(input);
        });
        
        // Submit form
        form.submit();
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if we're on the recommendations page and user hasn't applied yet
    if (document.getElementById('selected-programmes')) {
        window.studentApplicationManager = new StudentApplicationManager();
    }
});

// Handle Livewire navigation
document.addEventListener('livewire:navigated', function() {
    if (document.getElementById('selected-programmes')) {
        window.studentApplicationManager = new StudentApplicationManager();
    }
});