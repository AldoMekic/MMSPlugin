function wwInitializeSlider(sliderId) {
    const $ = jQuery;
    const container = $(`#${sliderId}`);
    const works = JSON.parse(container.attr('data-works'));
    const slider = container.find('.ww-slider');
    const prevBtn = container.find('.ww-prev-btn');
    const nextBtn = container.find('.ww-next-btn');

    let currentPage = 0;
    const worksPerPage = 3;

    function renderWorks() {
        slider.empty();
        const startIndex = currentPage * worksPerPage;
        const endIndex = Math.min(startIndex + worksPerPage, works.length);
        for (let i = startIndex; i < endIndex; i++) {
            const work = works[i];
            const card = `
                <div class="ww-card">
                    <h3 class="ww-title">${work.title}</h3>
                    <p class="ww-date">${work.date}</p>
                    <p class="ww-author">By: ${work.author}</p>
                    <a href="${work.link}" class="ww-link">Read More</a>
                </div>
            `;
            slider.append(card);
        }
        updateButtons();
    }

    function updateButtons() {
        prevBtn.prop('disabled', currentPage === 0);
        nextBtn.prop('disabled', (currentPage + 1) * worksPerPage >= works.length);
    }

    prevBtn.on('click', function () {
        if (currentPage > 0) {
            currentPage--;
            renderWorks();
        }
    });

    nextBtn.on('click', function () {
        if ((currentPage + 1) * worksPerPage < works.length) {
            currentPage++;
            renderWorks();
        }
    });

    renderWorks(); // Initialize the slider display
}

jQuery(document).ready(function () {
    // No initialization code here since sliders are dynamically initialized
});