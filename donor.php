<?php	
	
	include ('include/header.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Listing System</title>
    <style>
        :root {
            --primary-red: #e63946;
            --light-red: #f5b7bc;
            --dark-gray: #333333;
            --medium-gray: #6c757d;
            --light-gray: #f2f2f2;
            --white: #ffffff;
        }

    * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--dark-gray);
        }

        header {
            background-color: var(--primary-red);
            color: var(--white);
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 0.5rem;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
			
        }

        .card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
			width: 70rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .search-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input, select {
            padding: 0.75rem;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            flex: 1;
            min-width: 150px;
        }

        button {
            background-color: var(--primary-red);
            color: var(--white);
            border: none;
            border-radius: 4px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #d32f2f;
        }

        .btn-secondary {
            background-color: var(--medium-gray);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .donor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .donor-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary-red);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .donor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .donor-type {
            display: inline-block;
            background-color: var(--light-red);
            color: var(--primary-red);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .donor-info {
            margin-bottom: 1rem;
        }

        .donor-info h3 {
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }

        .donor-meta {
            display: flex;
            justify-content: space-between;
            color: var(--medium-gray);
            font-size: 0.9rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--light-gray);
        }

        .donation-history {
            color: var(--medium-gray);
            font-style: italic;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: var(--white);
            margin: 10% auto;
            padding: 2rem;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .close {
            color: var(--medium-gray);
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .pagination button {
            padding: 0.5rem 0.75rem;
        }

        .pagination .active {
            background-color: var(--dark-gray);
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: var(--medium-gray);
        }

        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            flex: 1;
            background-color: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-red);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--medium-gray);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stats-row {
                flex-direction: column;
            }
            
            .search-filters {
                flex-direction: column;
            }
        }

        .loading {
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            margin: 0 auto;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: var(--primary-red);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>
</head>
<body>
    <header>
        <h1>Blood Donor Directory</h1>
        <p>Find and connect with blood donors in your area</p>
    </header>

    <div class="container">
        <div class="card">
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number" id="total-donors">0</div>
                    <div class="stat-label">Total Donors</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="donations-month">0</div>
                    <div class="stat-label">Donations This Month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="urgent-requests">0</div>
                    <div class="stat-label">Urgent Requests</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="lives-saved">0</div>
                    <div class="stat-label">Lives Saved</div>
                </div>
            </div>

            <div class="search-filters">
                <input type="text" id="search-input" class="search-input" placeholder="Search by name, location...">
                <select id="blood-type-filter">
                    <option value="">All Blood Types</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <select id="location-filter">
                    <option value="">All Locations</option>
                    <!-- Will be populated dynamically -->
                </select>
                <select id="availability-filter">
                    <option value="">All Availability</option>
                    <option value="available">Available Now</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                <button id="search-btn">Search</button>
                <button id="reset-btn" class="btn-secondary">Reset</button>
                <button id="add-donor-btn">+ Add New Donor</button>
            </div>

            <div id="loading" class="loading">
                <div class="spinner"></div>
                <p>Loading donors...</p>
            </div>

            <div id="donor-list" class="donor-grid">
                <!-- Donor cards will be inserted here dynamically -->
            </div>

            <div id="no-results" class="no-results" style="display: none;">
                <h3>No donors found matching your criteria</h3>
                <p>Try adjusting your filters or search terms</p>
            </div>

            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be inserted here dynamically -->
            </div>
        </div>
    </div>

    <!-- Add Donor Modal -->
    <div id="add-donor-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Donor</h2>
                <span class="close">&times;</span>
            </div>
            <form id="add-donor-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="blood-type">Blood Type</label>
                    <select id="blood-type" name="bloodType" required>
                        <option value="">Select Blood Type</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" min="18" max="65" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" min="45" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="tel" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="last-donation">Last Donation Date</label>
                    <input type="date" id="last-donation" name="lastDonation">
                </div>
                <div class="form-group">
                    <label for="medical-conditions">Medical Conditions (if any)</label>
                    <textarea id="medical-conditions" name="medicalConditions" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select id="availability" name="availability" required>
                        <option value="available">Available Now</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel-btn" class="btn-secondary">Cancel</button>
                    <button type="submit" id="submit-btn">Add Donor</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donor Details Modal -->
    <div id="donor-details-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="detail-donor-name">Donor Details</h2>
                <span class="close">&times;</span>
            </div>
            <div id="donor-details-content">
                <!-- Donor details will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" id="contact-donor-btn">Contact Donor</button>
                <button type="button" id="close-details-btn" class="btn-secondary">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Database connection and operations will be simulated with local storage for frontend demo
        // In a real application, these would be AJAX calls to a backend API

        // Sample initial donor data
        const initialDonors = [
            {
                id: 1,
                name: "John Smith",
                bloodType: "O+",
                age: 32,
                weight: 75,
                location: "New York",
                contact: "555-1234",
                email: "john.smith@example.com",
                lastDonation: "2024-02-15",
                medicalConditions: "",
                availability: "available",
                donationCount: 12,
                lastUpdated: "2024-03-12"
            },
            {
                id: 2,
                name: "Maria Rodriguez",
                bloodType: "A-",
                age: 28,
                weight: 65,
                location: "Chicago",
                contact: "555-5678",
                email: "maria.r@example.com",
                lastDonation: "2024-01-20",
                medicalConditions: "Seasonal allergies",
                availability: "available",
                donationCount: 8,
                lastUpdated: "2024-03-05"
            },
            {
                id: 3,
                name: "Robert Johnson",
                bloodType: "AB+",
                age: 45,
                weight: 82,
                location: "Los Angeles",
                contact: "555-9012",
                email: "robert.j@example.com",
                lastDonation: "2023-11-30",
                medicalConditions: "",
                availability: "unavailable",
                donationCount: 20,
                lastUpdated: "2024-02-28"
            },
            {
                id: 4,
                name: "Sarah Wilson",
                bloodType: "B+",
                age: 35,
                weight: 68,
                location: "Boston",
                contact: "555-3456",
                email: "sarah.w@example.com",
                lastDonation: "2024-02-02",
                medicalConditions: "",
                availability: "available",
                donationCount: 15,
                lastUpdated: "2024-03-15"
            },
            {
                id: 5,
                name: "Michael Chen",
                bloodType: "O-",
                age: 30,
                weight: 70,
                location: "San Francisco",
                contact: "555-7890",
                email: "michael.c@example.com",
                lastDonation: "2024-03-01",
                medicalConditions: "",
                availability: "available",
                donationCount: 6,
                lastUpdated: "2024-03-20"
            },
            {
                id: 6,
                name: "Emily Brown",
                bloodType: "A+",
                age: 26,
                weight: 62,
                location: "Seattle",
                contact: "555-2345",
                email: "emily.b@example.com",
                lastDonation: "2023-12-15",
                medicalConditions: "Low iron (resolved)",
                availability: "available",
                donationCount: 4,
                lastUpdated: "2024-03-10"
            },
            {
                id: 7,
                name: "David Kim",
                bloodType: "B-",
                age: 40,
                weight: 78,
                location: "Chicago",
                contact: "555-6789",
                email: "david.k@example.com",
                lastDonation: "2024-01-10",
                medicalConditions: "",
                availability: "unavailable",
                donationCount: 18,
                lastUpdated: "2024-02-20"
            },
            {
                id: 8,
                name: "Lisa Garcia",
                bloodType: "O+",
                age: 33,
                weight: 67,
                location: "Miami",
                contact: "555-0123",
                email: "lisa.g@example.com",
                lastDonation: "2024-02-20",
                medicalConditions: "",
                availability: "available",
                donationCount: 10,
                lastUpdated: "2024-03-18"
            }
        ];

        // Initialize the local storage if it's empty
        if (!localStorage.getItem('donors')) {
            localStorage.setItem('donors', JSON.stringify(initialDonors));
        }

        // Database operations simulation
        const donorDatabase = {
            getAllDonors: function() {
                return JSON.parse(localStorage.getItem('donors')) || [];
            },
            
            addDonor: function(donor) {
                const donors = this.getAllDonors();
                const newId = donors.length > 0 ? Math.max(...donors.map(d => d.id)) + 1 : 1;
                
                const newDonor = {
                    ...donor,
                    id: newId,
                    donationCount: 0,
                    lastUpdated: new Date().toISOString().split('T')[0]
                };
                
                donors.push(newDonor);
                localStorage.setItem('donors', JSON.stringify(donors));
                return newDonor;
            },
            
            getDonorById: function(id) {
                const donors = this.getAllDonors();
                return donors.find(donor => donor.id === id);
            },
            
            updateDonor: function(id, updates) {
                let donors = this.getAllDonors();
                const index = donors.findIndex(donor => donor.id === id);
                
                if (index !== -1) {
                    donors[index] = { ...donors[index], ...updates, lastUpdated: new Date().toISOString().split('T')[0] };
                    localStorage.setItem('donors', JSON.stringify(donors));
                    return donors[index];
                }
                
                return null;
            },
            
            deleteDonor: function(id) {
                let donors = this.getAllDonors();
                donors = donors.filter(donor => donor.id !== id);
                localStorage.setItem('donors', JSON.stringify(donors));
            },
            
            searchDonors: function(filters) {
                let donors = this.getAllDonors();
                
                if (filters.searchText) {
                    const searchText = filters.searchText.toLowerCase();
                    donors = donors.filter(donor => 
                        donor.name.toLowerCase().includes(searchText) ||
                        donor.location.toLowerCase().includes(searchText) ||
                        donor.email.toLowerCase().includes(searchText)
                    );
                }
                
                if (filters.bloodType) {
                    donors = donors.filter(donor => donor.bloodType === filters.bloodType);
                }
                
                if (filters.location) {
                    donors = donors.filter(donor => donor.location === filters.location);
                }
                
                if (filters.availability) {
                    donors = donors.filter(donor => donor.availability === filters.availability);
                }
                
                return donors;
            },
            
            getStatistics: function() {
                const donors = this.getAllDonors();
                const now = new Date();
                const monthStart = new Date(now.getFullYear(), now.getMonth(), 1);
                
                const donationsThisMonth = donors.filter(donor => {
                    const donationDate = new Date(donor.lastDonation);
                    return donationDate >= monthStart && donationDate <= now;
                }).length;
                
                // This would be calculated differently in a real app
                const livesSaved = donors.reduce((total, donor) => total + donor.donationCount, 0) * 3;
                
                // Count urgent requests (this is simulated - in a real app would be from requests table)
                const urgentRequests = Math.floor(Math.random() * 10) + 1;
                
                return {
                    totalDonors: donors.length,
                    donationsThisMonth: donationsThisMonth,
                    urgentRequests: urgentRequests,
                    livesSaved: livesSaved
                };
            }
        };

        // UI Controller
        const UIController = {
            // DOM Elements
            domElements: {
                donorList: document.getElementById('donor-list'),
                searchInput: document.getElementById('search-input'),
                bloodTypeFilter: document.getElementById('blood-type-filter'),
                locationFilter: document.getElementById('location-filter'),
                availabilityFilter: document.getElementById('availability-filter'),
                searchBtn: document.getElementById('search-btn'),
                resetBtn: document.getElementById('reset-btn'),
                addDonorBtn: document.getElementById('add-donor-btn'),
                addDonorModal: document.getElementById('add-donor-modal'),
                addDonorForm: document.getElementById('add-donor-form'),
                cancelBtn: document.getElementById('cancel-btn'),
                submitBtn: document.getElementById('submit-btn'),
                donorDetailsModal: document.getElementById('donor-details-modal'),
                detailDonorName: document.getElementById('detail-donor-name'),
                donorDetailsContent: document.getElementById('donor-details-content'),
                contactDonorBtn: document.getElementById('contact-donor-btn'),
                closeDetailsBtn: document.getElementById('close-details-btn'),
                noResults: document.getElementById('no-results'),
                pagination: document.getElementById('pagination'),
                loading: document.getElementById('loading'),
                totalDonors: document.getElementById('total-donors'),
                donationsMonth: document.getElementById('donations-month'),
                urgentRequests: document.getElementById('urgent-requests'),
                livesSaved: document.getElementById('lives-saved')
            },
            
            init: function() {
                this.populateLocationFilter();
                this.displayDonors();
                this.displayStatistics();
                this.setupEventListeners();
            },
            
            populateLocationFilter: function() {
                const donors = donorDatabase.getAllDonors();
                const locations = [...new Set(donors.map(donor => donor.location))].sort();
                
                const locationSelect = this.domElements.locationFilter;
                
                // Clear existing options (except the first 'All' option)
                while (locationSelect.options.length > 1) {
                    locationSelect.remove(1);
                }
                
                // Add location options
                locations.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location;
                    option.textContent = location;
                    locationSelect.appendChild(option);
                });
            },
            
            displayDonors: function(filteredDonors = null, page = 1) {
                this.domElements.loading.style.display = 'block';
                this.domElements.donorList.style.display = 'none';
                this.domElements.noResults.style.display = 'none';
                
                // Simulate loading delay (would be a real API call in production)
                setTimeout(() => {
                    const donors = filteredDonors || donorDatabase.getAllDonors();
                    const donorList = this.domElements.donorList;
                    
                    // Clear existing donor cards
                    donorList.innerHTML = '';
                    
                    // Pagination settings
                    const itemsPerPage = 8;
                    const totalPages = Math.ceil(donors.length / itemsPerPage);
                    const startIndex = (page - 1) * itemsPerPage;
                    const paginatedDonors = donors.slice(startIndex, startIndex + itemsPerPage);
                    
                    if (donors.length === 0) {
                        this.domElements.noResults.style.display = 'block';
                        this.domElements.donorList.style.display = 'none';
                    } else {
                        // Create and append donor cards
                        paginatedDonors.forEach(donor => {
                            const donorCard = this.createDonorCard(donor);
                            donorList.appendChild(donorCard);
                        });
                        
                        this.domElements.donorList.style.display = 'grid';
                        this.domElements.noResults.style.display = 'none';
                    }
                    
                    this.domElements.loading.style.display = 'none';
                    this.createPagination(totalPages, page, filteredDonors);
                }, 500);
            },
            
            createDonorCard: function(donor) {
                const donorCard = document.createElement('div');
                donorCard.className = 'donor-card';
                donorCard.dataset.id = donor.id;
                
                // Calculate days since last donation
                let daysSince = '';
                if (donor.lastDonation) {
                    const lastDonation = new Date(donor.lastDonation);
                    const today = new Date();
                    const diffTime = Math.abs(today - lastDonation);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    daysSince = ${diffDays} days ago;
                } else {
                    daysSince = 'No donations yet';
                }
                
                // Determine availability status for styling
                const availabilityClass = donor.availability === 'available' ? 'text-success' : 'text-danger';
                
                donorCard.innerHTML = `
                    <div class="donor-type">${donor.bloodType}</div>
                    <div class="donor-info">
                        <h3>${donor.name}</h3>
                        <p>${donor.location} · ${donor.age} years</p>
                        <p class="donation-history">
                            <small>${donor.donationCount} donations total · Last donated: ${daysSince}</small>
                        </p>
                    </div>
                    <div class="donor-meta">
                        <span>Status: <strong class="${availabilityClass}">${donor.availability === 'available' ? 'Available' : 'Unavailable'}</strong></span>
                        <span>Last updated: ${formatDate(donor.lastUpdated)}</span>
                    </div>
                `;
                
                // Add click event to show donor details
                donorCard.addEventListener('click', () => {
                    this.showDonorDetails(donor.id);
                });
                
                return donorCard;
            },
            
            createPagination: function(totalPages, currentPage, filteredDonors) {
                const pagination = this.domElements.pagination;
                pagination.innerHTML = '';
                
                if (totalPages <= 1) {
                    pagination.style.display = 'none';
                    return;
                }
                
                pagination.style.display = 'flex';
                
                // Previous button
                const prevButton = document.createElement('button');
                prevButton.textContent = '←';
                prevButton.disabled = currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        this.displayDonors(filteredDonors, currentPage - 1);
                    }
                });
                pagination.appendChild(prevButton);
                
                // Page numbers
                const maxVisiblePages = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
                
                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }
                
                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    if (i === currentPage) {
                        pageButton.classList.add('active');
                    }
                    
                    pageButton.addEventListener('click', () => {
                        this.displayDonors(filteredDonors, i);
                    });
                    
                    pagination.appendChild(pageButton);
                }
                
                // Next button
                const nextButton = document.createElement('button');
                nextButton.textContent = '→';
                nextButton.disabled = currentPage === totalPages;
                nextButton.addEventListener('click', () => {
					if (currentPage < totalPages) {
                        this.displayDonors(filteredDonors, currentPage + 1);
                    }
                });
                pagination.appendChild(nextButton);
            },
            
            showDonorDetails: function(donorId) {
                const donor = donorDatabase.getDonorById(donorId);
                if (!donor) return;
                
                this.domElements.detailDonorName.textContent = donor.name;
                
                const contentHtml = `
                    <div style="display: flex; margin-bottom: 1.5rem;">
                        <div style="flex: 1; padding-right: 1rem;">
                            <p><strong>Blood Type:</strong> <span style="color: var(--primary-red); font-weight: bold;">${donor.bloodType}</span></p>
                            <p><strong>Age:</strong> ${donor.age} years</p>
                            <p><strong>Weight:</strong> ${donor.weight} kg</p>
                            <p><strong>Location:</strong> ${donor.location}</p>
                            <p><strong>Availability:</strong> ${donor.availability === 'available' ? 'Available Now' : 'Unavailable'}</p>
                        </div>
                        <div style="flex: 1; padding-left: 1rem; border-left: 1px solid var(--light-gray);">
                            <p><strong>Contact:</strong> ${donor.contact}</p>
                            <p><strong>Email:</strong> ${donor.email}</p>
                            <p><strong>Last Donation:</strong> ${donor.lastDonation ? formatDate(donor.lastDonation) : 'No donations recorded'}</p>
                            <p><strong>Total Donations:</strong> ${donor.donationCount}</p>
                            <p><strong>Medical Notes:</strong> ${donor.medicalConditions || 'None'}</p>
                        </div>
                    </div>
                    <div>
                        <h4>Donation History</h4>
                        <p>This donor has made ${donor.donationCount} donations in total.</p>
                        ${donor.donationCount > 0 ? 
                            <p>Their contributions have potentially helped save up to ${donor.donationCount * 3} lives.</p> : 
                            '<p>They have not made any donations yet.</p>'}
                    </div>
                `;
                
                this.domElements.donorDetailsContent.innerHTML = contentHtml;
                this.domElements.contactDonorBtn.style.display = donor.availability === 'available' ? 'block' : 'none';
                this.domElements.donorDetailsModal.style.display = 'block';
                
                // Set up the contact button
                this.domElements.contactDonorBtn.onclick = () => {
                    alert(Contact information for ${donor.name}:\nPhone: ${donor.contact}\nEmail: ${donor.email});
                };
            },
            
            displayStatistics: function() {
                const stats = donorDatabase.getStatistics();
                this.domElements.totalDonors.textContent = stats.totalDonors;
                this.domElements.donationsMonth.textContent = stats.donationsThisMonth;
                this.domElements.urgentRequests.textContent = stats.urgentRequests;
                this.domElements.livesSaved.textContent = stats.livesSaved;
            },
            
            setupEventListeners: function() {
                // Search functionality
                this.domElements.searchBtn.addEventListener('click', () => {
                    this.searchDonors();
                });
                
                // Enter key in search input
                this.domElements.searchInput.addEventListener('keyup', (e) => {
                    if (e.key === 'Enter') {
                        this.searchDonors();
                    }
                });
                
                // Reset filters
                this.domElements.resetBtn.addEventListener('click', () => {
                    this.domElements.searchInput.value = '';
                    this.domElements.bloodTypeFilter.value = '';
                    this.domElements.locationFilter.value = '';
                    this.domElements.availabilityFilter.value = '';
                    this.displayDonors();
                });
                
                // Add donor button
                this.domElements.addDonorBtn.addEventListener('click', () => {
                    this.domElements.addDonorForm.reset();
                    this.domElements.addDonorModal.style.display = 'block';
                });
                
                // Cancel add donor
                this.domElements.cancelBtn.addEventListener('click', () => {
                    this.domElements.addDonorModal.style.display = 'none';
                });
                
                // Close modals when clicking on X
                const closeButtons = document.querySelectorAll('.close');
                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        this.domElements.addDonorModal.style.display = 'none';
                        this.domElements.donorDetailsModal.style.display = 'none';
                    });
                });
                
                // Close donor details
                this.domElements.closeDetailsBtn.addEventListener('click', () => {
                    this.domElements.donorDetailsModal.style.display = 'none';
                });
                
                // Close modals when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target === this.domElements.addDonorModal) {
                        this.domElements.addDonorModal.style.display = 'none';
                    }
                    if (e.target === this.domElements.donorDetailsModal) {
                        this.domElements.donorDetailsModal.style.display = 'none';
                    }
                });
                
                // Form submission
                this.domElements.addDonorForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    // Gather form data
                    const formData = new FormData(this.domElements.addDonorForm);
                    const donorData = {
                        name: formData.get('name'),
                        bloodType: formData.get('bloodType'),
                        age: parseInt(formData.get('age')),
                        weight: parseInt(formData.get('weight')),
                        location: formData.get('location'),
                        contact: formData.get('contact'),
                        email: formData.get('email'),
                        lastDonation: formData.get('lastDonation') || null,
                        medicalConditions: formData.get('medicalConditions'),
                        availability: formData.get('availability')
                    };
                    
                    // Add the donor to the database
                    donorDatabase.addDonor(donorData);
                    
                    // Refresh the donor list and location filter
                    this.populateLocationFilter();
                    this.displayDonors();
                    this.displayStatistics();
                    
                    // Close the modal
                    this.domElements.addDonorModal.style.display = 'none';
                    
                    // Show confirmation
                    alert(${donorData.name} has been added as a donor!);
                });
            },
            
            searchDonors: function() {
                const filters = {
                    searchText: this.domElements.searchInput.value,
                    bloodType: this.domElements.bloodTypeFilter.value,
                    location: this.domElements.locationFilter.value,
                    availability: this.domElements.availabilityFilter.value
                };
                
                const filteredDonors = donorDatabase.searchDonors(filters);
                this.displayDonors(filteredDonors);
            }
        };

        // Helper function to format dates
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            UIController.init();
        });
    </script>
</body>
</html>
<?php	

	include ('include/footer.php'); 
	include ('database/connection.php'); 

?>
<?php
// index.php - PHP backend with MySQL database connection

// Load environment variables from .env file	



// Create database connection
try {
    $pdo = new PDO(
        "mysql:host=$$serverName ;dbname=$database;charset=utf8mb4",
        $uid,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
    // Test connection
    $pdo->query('SELECT 1');
    // error_log('Database connection successful');
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Enable CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Set content type to JSON
header('Content-Type: application/json');

// Get request method and path
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$uriParts = parse_url($requestUri);
$path = $uriParts['path'];

// Parse query parameters if any
$queryParams = [];
if (isset($uriParts['query'])) {
    parse_str($uriParts['query'], $queryParams);
}

// Parse JSON body for POST and PUT requests
$jsonBody = null;
if ($requestMethod === 'POST' || $requestMethod === 'PUT') {
    $jsonBody = json_decode(file_get_contents('php://input'), true);
}

// Extract path parameters
$pathParts = explode('/', trim($path, '/'));
$apiIndex = array_search('api', $pathParts);
if ($apiIndex !== false) {
    $pathParts = array_slice($pathParts, $apiIndex + 1);
}

// Router
// Get all donors
if ($requestMethod === 'GET' && $pathParts[0] === 'donors' && count($pathParts) === 1) {
    try {
        $stmt = $pdo->query('SELECT * FROM donors');
        $donors = $stmt->fetchAll();
        echo json_encode($donors);
    } catch (PDOException $e) {
        error_log('Error fetching donors: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch donors']);
    }
}

// Get donor by ID
elseif ($requestMethod === 'GET' && $pathParts[0] === 'donors' && count($pathParts) === 2 && is_numeric($pathParts[1])) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM donors WHERE id = ?');
        $stmt->execute([$pathParts[1]]);
        $donor = $stmt->fetch();
        
        if (!$donor) {
            http_response_code(404);
            echo json_encode(['error' => 'Donor not found']);
            exit;
        }
        
        echo json_encode($donor);
    } catch (PDOException $e) {
        error_log('Error fetching donor: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch donor']);
    }
}

// Add new donor
elseif ($requestMethod === 'POST' && $pathParts[0] === 'donors' && count($pathParts) === 1) {
    // Validate required fields
    if (!isset($jsonBody['name']) || !isset($jsonBody['bloodType']) || !isset($jsonBody['age']) || 
        !isset($jsonBody['weight']) || !isset($jsonBody['location']) || !isset($jsonBody['contact']) || 
        !isset($jsonBody['email']) || !isset($jsonBody['availability'])) {
        http_response_code(400);
        echo json_encode(['error' => 'All required fields must be provided']);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO donors (
                name, blood_type, age, weight, location, 
                contact, email, last_donation, medical_conditions, availability, 
                donation_count, last_updated
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, NOW())'
        );
        
        $stmt->execute([
            $jsonBody['name'],
            $jsonBody['bloodType'],
            $jsonBody['age'],
            $jsonBody['weight'],
            $jsonBody['location'],
            $jsonBody['contact'],
            $jsonBody['email'],
            $jsonBody['lastDonation'] ?? null,
            $jsonBody['medicalConditions'] ?? '',
            $jsonBody['availability']
        ]);
        
        $newId = $pdo->lastInsertId();
        
        http_response_code(201);
        echo json_encode([
            'id' => $newId,
            'name' => $jsonBody['name'],
            'bloodType' => $jsonBody['bloodType'],
            'age' => $jsonBody['age'],
            'weight' => $jsonBody['weight'],
            'location' => $jsonBody['location'],
            'contact' => $jsonBody['contact'],
            'email' => $jsonBody['email'],
            'lastDonation' => $jsonBody['lastDonation'] ?? null,
            'medicalConditions' => $jsonBody['medicalConditions'] ?? '',
            'availability' => $jsonBody['availability'],
            'donationCount' => 0,
            'lastUpdated' => date('Y-m-d H:i:s')
        ]);
    } catch (PDOException $e) {
        error_log('Error adding donor: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add donor']);
    }
}

// Update donor
elseif ($requestMethod === 'PUT' && $pathParts[0] === 'donors' && count($pathParts) === 2 && is_numeric($pathParts[1])) {
    try {
        $stmt = $pdo->prepare(
            'UPDATE donors SET 
                name = ?, 
                blood_type = ?, 
                age = ?, 
                weight = ?, 
                location = ?, 
                contact = ?, 
                email = ?, 
                last_donation = ?, 
                medical_conditions = ?, 
                availability = ?, 
                last_updated = NOW()
            WHERE id = ?'
        );
        
        $result = $stmt->execute([
            $jsonBody['name'],
            $jsonBody['bloodType'],
            $jsonBody['age'],
            $jsonBody['weight'],
            $jsonBody['location'],
            $jsonBody['contact'],
            $jsonBody['email'],
            $jsonBody['lastDonation'] ?? null,
            $jsonBody['medicalConditions'] ?? '',
            $jsonBody['availability'],
            $pathParts[1]
        ]);
        
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Donor not found']);
            exit;
        }
        
        echo json_encode([
            'id' => (int)$pathParts[1],
            'name' => $jsonBody['name'],
            'bloodType' => $jsonBody['bloodType'],
            'age' => $jsonBody['age'],
            'weight' => $jsonBody['weight'],
            'location' => $jsonBody['location'],
            'contact' => $jsonBody['contact'],
            'email' => $jsonBody['email'],
            'lastDonation' => $jsonBody['lastDonation'] ?? null,
            'medicalConditions' => $jsonBody['medicalConditions'] ?? '',
            'availability' => $jsonBody['availability'],
            'lastUpdated' => date('Y-m-d H:i:s')
        ]);
    } catch (PDOException $e) {
        error_log('Error updating donor: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update donor']);
    }
}

// Delete donor
elseif ($requestMethod === 'DELETE' && $pathParts[0] === 'donors' && count($pathParts) === 2 && is_numeric($pathParts[1])) {
    try {
        $stmt = $pdo->prepare('DELETE FROM donors WHERE id = ?');
        $stmt->execute([$pathParts[1]]);
        
        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Donor not found']);
            exit;
        }
        
        echo json_encode(['message' => 'Donor deleted successfully']);
    } catch (PDOException $e) {
        error_log('Error deleting donor: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete donor']);
    }
}

// Search donors with filters
elseif ($requestMethod === 'GET' && $pathParts[0] === 'donors' && $pathParts[1] === 'search') {
    $searchText = $queryParams['searchText'] ?? null;
    $bloodType = $queryParams['bloodType'] ?? null;
    $location = $queryParams['location'] ?? null;
    $availability = $queryParams['availability'] ?? null;
    
    try {
        $query = 'SELECT * FROM donors WHERE 1=1';
        $params = [];
        
        if ($searchText) {
            $query .= ' AND (name LIKE ? OR location LIKE ? OR email LIKE ?)';
            $searchPattern = "%$searchText%";
            array_push($params, $searchPattern, $searchPattern, $searchPattern);
        }
        
        if ($bloodType) {
            $query .= ' AND blood_type = ?';
            $params[] = $bloodType;
        }
        
        if ($location) {
            $query .= ' AND location = ?';
            $params[] = $location;
        }
        
        if ($availability) {
            $query .= ' AND availability = ?';
            $params[] = $availability;
        }
        
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $donors = $stmt->fetchAll();
        
        echo json_encode($donors);
    } catch (PDOException $e) {
        error_log('Error searching donors: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to search donors']);
    }
}

// Get statistics
elseif ($requestMethod === 'GET' && $pathParts[0] === 'statistics') {
    try {
        // Get total donors
        $stmt = $pdo->query('SELECT COUNT(*) as total FROM donors');
        $totalDonors = $stmt->fetch()['total'];
        
        // Get donations this month
        $stmt = $pdo->query(
            'SELECT COUNT(*) as monthly FROM donations WHERE MONTH(donation_date) = MONTH(CURRENT_DATE()) AND YEAR(donation_date) = YEAR(CURRENT_DATE())'
        );
        $donationsThisMonth = $stmt->fetch()['monthly'];
        
        // Get urgent requests
        $stmt = $pdo->query(
            'SELECT COUNT(*) as urgent FROM donation_requests WHERE is_urgent = 1 AND status = "active"'
        );
        $urgentRequests = $stmt->fetch()['urgent'];
        
        // Get total donations (approximate lives saved)
        $stmt = $pdo->query('SELECT SUM(donation_count) as total FROM donors');
        $totalDonations = $stmt->fetch()['total'] ?? 0;
        $livesSaved = $totalDonations * 3; // Assuming each donation can save up to 3 lives
        
        echo json_encode([
            'totalDonors' => $totalDonors,
            'donationsThisMonth' => $donationsThisMonth,
            'urgentRequests' => $urgentRequests,
            'livesSaved' => $livesSaved
        ]);
    } catch (PDOException $e) {
        error_log('Error fetching statistics: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch statistics']);
    }
}

// Record a new donation
elseif ($requestMethod === 'POST' && $pathParts[0] === 'donations') {
    // Validate required fields
    if (!isset($jsonBody['donorId']) || !isset($jsonBody['donationDate']) || !isset($jsonBody['location'])) {
        http_response_code(400);
        echo json_encode(['error' => 'All required fields must be provided']);
        exit;
    }
    
    try {
        $pdo->beginTransaction();
        
        // Add the donation record
        $stmt = $pdo->prepare(
            'INSERT INTO donations (
                donor_id, donation_date, location, amount, notes, created_at
            ) VALUES (?, ?, ?, ?, ?, NOW())'
        );
        
        $stmt->execute([
            $jsonBody['donorId'],
            $jsonBody['donationDate'],
            $jsonBody['location'],
            $jsonBody['amount'] ?? 1,
            $jsonBody['notes'] ?? ''
        ]);
        
        $newId = $pdo->lastInsertId();
        
        // Update the donor's donation count and last donation date
        $stmt = $pdo->prepare(
            'UPDATE donors SET 
                donation_count = donation_count + 1, 
                last_donation = ?, 
                last_updated = NOW()
            WHERE id = ?'
        );
        
        $stmt->execute([
            $jsonBody['donationDate'],
            $jsonBody['donorId']
        ]);
        
        $pdo->commit();
        
        http_response_code(201);
        echo json_encode([
            'id' => $newId,
            'donorId' => $jsonBody['donorId'],
            'donationDate' => $jsonBody['donationDate'],
            'location' => $jsonBody['location'],
            'amount' => $jsonBody['amount'] ?? 1,
            'notes' => $jsonBody['notes'] ?? '',
            'createdAt' => date('Y-m-d H:i:s')
        ]);
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log('Error recording donation: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to record donation']);
    }
}

// Get all locations
elseif ($requestMethod === 'GET' && $pathParts[0] === 'locations') {
    try {
        $stmt = $pdo->query('SELECT DISTINCT location FROM donors ORDER BY location');
        $locations = array_column($stmt->fetchAll(), 'location');
        echo json_encode($locations);
    } catch (PDOException $e) {
        error_log('Error fetching locations: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch locations']);
    }
}

// Get donation history for a donor
elseif ($requestMethod === 'GET' && $pathParts[0] === 'donors' && is_numeric($pathParts[1]) && $pathParts[2] === 'donations') {
    try {
        $stmt = $pdo->prepare(
            'SELECT * FROM donations WHERE donor_id = ? ORDER BY donation_date DESC'
        );
        $stmt->execute([$pathParts[1]]);
        $donations = $stmt->fetchAll();
        echo json_encode($donations);
    } catch (PDOException $e) {
        error_log('Error fetching donation history: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch donation history']);
    }
}

// Route not found
else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
}
?>