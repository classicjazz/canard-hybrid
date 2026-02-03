/**
 * Navigation.js
 * * Handles toggling the navigation menu for small screens and enables TAB key 
 * navigation support for dropdown menus.
 * * Refactored to Vanilla JS (ES6+)
 */
(function() {
    'use strict';

    /**
     * Initialize Navigation Logic
     */
    const initNavigation = () => {
        const container = document.getElementById('site-navigation');
        if (!container) return;

        const button = container.querySelector('button');
        const menu = container.querySelector('ul');

        // 1. Mobile Menu Toggle (Hamburger)
        // ---------------------------------------------------------
        if (!button) return;

        // Verify menu exists, otherwise hide button
        if (!menu || !menu.childNodes.length) {
            button.style.display = 'none';
            return;
        }

        // Initialize ARIA
        menu.setAttribute('aria-expanded', 'false');
        if (!menu.classList.contains('nav-menu')) {
            menu.classList.add('nav-menu');
        }

        // Toggle Logic
        button.addEventListener('click', () => {
            container.classList.toggle('toggled');
            const isToggled = container.classList.contains('toggled');
            
            button.setAttribute('aria-expanded', isToggled);
            menu.setAttribute('aria-expanded', isToggled);
        });

        // 2. Dropdown Button Management (Resize & Init)
        // ---------------------------------------------------------
        const manageDropdownButtons = () => {
            const width = window.innerWidth;
            const parentLinks = document.querySelectorAll(
                '.main-navigation .page_item_has_children > a, ' +
                '.main-navigation .menu-item-has-children > a, ' +
                '.widget_nav_menu .page_item_has_children > a, ' +
                '.widget_nav_menu .menu-item-has-children > a'
            );

            // Desktop View: Remove buttons
            if (width > 959) {
                const existingButtons = document.querySelectorAll('.main-navigation .dropdown-toggle');
                existingButtons.forEach(btn => btn.remove());
            } 
            // Mobile/Tablet View: Add buttons if missing
            else {
                parentLinks.forEach(link => {
                    // Check if button already exists in this parent
                    if (!link.parentNode.querySelector('.dropdown-toggle')) {
                        // Create button
                        const toggleBtn = document.createElement('button');
                        toggleBtn.className = 'dropdown-toggle';
                        toggleBtn.setAttribute('aria-expanded', 'false');
                        // Append after the link
                        link.insertAdjacentElement('afterend', toggleBtn); 
                    }
                });
            }
        };

        // Run on Load and Resize (debounced)
        manageDropdownButtons();
        window.addEventListener('resize', window.canardUtils.debounce(manageDropdownButtons, 500));


        // 3. Event Delegation for Sub-menu Toggles & Interactions
        // ---------------------------------------------------------
        // We attach listeners to the container to handle dynamic elements
        
        const masthead = document.getElementById('masthead');
        const menuDiv = masthead ? masthead.querySelector('div') : null;

        if (menuDiv) {
            
            // A. Click Handling for Dropdown Toggles
            menuDiv.addEventListener('click', (e) => {
                // Check if clicked element is our .dropdown-toggle
                if (e.target && e.target.classList.contains('dropdown-toggle')) {
                    e.preventDefault();
                    
                    const toggleBtn = e.target;
                    const menuItem = toggleBtn.parentNode; // The <li> or wrapper
                    
                    // Toggle class on button
                    toggleBtn.classList.toggle('toggled');
                    
                    // Toggle class on the sub-menu sibling
                    // We look for .children or .sub-menu within the parent <li>
                    const subMenu = menuItem.querySelector('.children, .sub-menu');
                    if (subMenu) {
                        subMenu.classList.toggle('toggled');
                    }
                    
                    // Update ARIA
                    const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                    toggleBtn.setAttribute('aria-expanded', !expanded);
                }
            });

            // B. Touch Support (Double tap to go)
            if ('ontouchstart' in window) {
                const parentLinks = menuDiv.querySelectorAll('.menu-item-has-children > a');
                
                parentLinks.forEach(link => {
                    link.addEventListener('touchstart', (e) => {
                        const el = link.parentNode; // The <li>
                        
                        if (!el.classList.contains('focus')) {
                            e.preventDefault();
                            el.classList.toggle('focus');
                            
                            // Remove focus from siblings
                            const siblings = el.parentNode.children;
                            Array.from(siblings).forEach(sibling => {
                                if (sibling !== el && sibling.classList.contains('focus')) {
                                    sibling.classList.remove('focus');
                                }
                            });
                        }
                    }, { passive: false }); // Passive false required to use preventDefault
                });
            }

            // C. Keyboard Accessibility (Focus/Blur)
            // Using focusin/focusout for bubbling support implies less event listeners overhead
            menuDiv.addEventListener('focusin', (e) => {
                if (e.target.tagName === 'A') {
                    const parentItem = e.target.closest('.menu-item');
                    if (parentItem) parentItem.classList.add('focus');
                }
            });

            menuDiv.addEventListener('focusout', (e) => {
                // We need a slight delay or check to see if focus moved *outside* the parent
                // However, the original script simply toggled logic on focus/blur.
                // To match original behavior strictly:
                if (e.target.tagName === 'A') {
                    const parentItem = e.target.closest('.menu-item');
                    if (parentItem) parentItem.classList.remove('focus');
                }
            });
        }
    };

    // Initialize on DOM Ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavigation);
    } else {
        initNavigation();
    }

})();