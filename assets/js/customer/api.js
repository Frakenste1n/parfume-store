/**
 * ==========================================
 * AURA PERFUME STORE - API HELPER
 * ==========================================
 */

const API_URL = `${BASE_URL}api`;

function uploadUrl(folder, filename)
{
    if (!filename)
    {
        return '';
    }

    return `${BASE_URL}uploads/${folder}/${filename}`;
}

/**
 * ==========================================
 * API REQUEST
 * ==========================================
 */

async function apiGet(endpoint)
{
    try
    {
        const response = await fetch(
            `${API_URL}/${endpoint}`,
            {
                method: 'GET',
                headers:
                {
                    'Accept': 'application/json'
                }
            }
        );

        const result = await response.json();

        if (!result.success)
        {
            throw new Error(
                result.message || 'Request gagal'
            );
        }

        return result.data;
    }
    catch(error)
    {
        console.error(
            '[API GET ERROR]',
            error
        );

        throw error;
    }
}

async function apiPost(endpoint, payload = {})
{
    try
    {
        const response = await fetch(
            `${API_URL}/${endpoint}`,
            {
                method: 'POST',
                headers:
                {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            }
        );

        const result = await response.json();

        if (!result.success)
        {
            throw new Error(
                result.message || 'Request gagal'
            );
        }

        return result.data;
    }
    catch(error)
    {
        console.error(
            '[API POST ERROR]',
            error
        );

        throw error;
    }
}

async function apiDelete(endpoint)
{
    try
    {
        const response = await fetch(
            `${API_URL}/${endpoint}`,
            {
                method: 'DELETE',
                headers:
                {
                    'Accept': 'application/json'
                }
            }
        );

        const result = await response.json();

        if (!result.success)
        {
            throw new Error(
                result.message || 'Request gagal'
            );
        }

        return result.data;
    }
    catch(error)
    {
        console.error(
            '[API DELETE ERROR]',
            error
        );

        throw error;
    }
}

async function apiPut(endpoint, payload = {})
{
    try
    {
        const response = await fetch(
            `${API_URL}/${endpoint}`,
            {
                method: 'PUT',
                headers:
                {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            }
        );

        const result = await response.json();

        if (!result.success)
        {
            throw new Error(
                result.message || 'Request gagal'
            );
        }

        return result.data;
    }
    catch(error)
    {
        console.error(
            '[API PUT ERROR]',
            error
        );

        throw error;
    }
}

/**
 * ==========================================
 * FORMATTER
 * ==========================================
 */

function formatRupiah(amount)
{
    return new Intl.NumberFormat(
        'id-ID',
        {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }
    ).format(amount);
}

function formatNumber(number)
{
    return new Intl.NumberFormat(
        'id-ID'
    ).format(number);
}



/**
 * ==========================================
 * UI STATE
 * ==========================================
 */

function showLoading(element)
{
    element.innerHTML = `
        <div class="loading-state">
            <div class="loading-spinner"></div>
            <p>Loading...</p>
        </div>
    `;
}

function showEmpty(
    element,
    message = 'Data tidak tersedia'
)
{
    element.innerHTML = `
        <div class="empty-state">
            <p>${message}</p>
        </div>
    `;
}

function showError(
    element,
    message = 'Terjadi kesalahan'
)
{
    element.innerHTML = `
        <div class="error-state">
            <p>${message}</p>
        </div>
    `;
}

/**
 * ==========================================
 * STRING HELPER
 * ==========================================
 */

function truncate(text, length = 100)
{
    if (!text)
    {
        return '';
    }

    return text.length > length
        ? text.substring(0, length) + '...'
        : text;
}

function slugify(text)
{
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
}

/**
 * ==========================================
 * DEBOUNCE
 * ==========================================
 */

function debounce(callback, delay = 500)
{
    let timeout;

    return (...args) =>
    {
        clearTimeout(timeout);

        timeout = setTimeout(
            () => callback(...args),
            delay
        );
    };
}

/**
 * ==========================================
 * NOTIFICATION
 * ==========================================
 */

function toast(
    message,
    type = 'success'
)
{
    console.log(
        `[${type.toUpperCase()}]`,
        message
    );
}