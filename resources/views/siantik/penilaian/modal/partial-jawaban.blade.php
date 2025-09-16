@foreach ($jawabans as $jawaban)
    @foreach ($jawaban->penilaianPilihans as $pilihan)
        <tr>
            <td class="text-center align-top">{{ $pilihan->pilihan->tingkat ?? '-' }}</td>
            <td class="text-gray-700">{{ $pilihan->pilihan->deskripsi ?? '-' }}</td>
            <td class="text-center">
                <input type="radio"
                       name="penilaian_mandiri_{{ $jawaban->id }}"
                       class="form-check-input"
                       value="{{ $pilihan->id }}"
                       {{ $pilihan->is_select ? 'checked' : '' }} />
            </td>
        </tr>
    @endforeach
@endforeach