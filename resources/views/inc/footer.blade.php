<footer>
    <p class="footer-title">О компании</p>
    <p class="info">PLC-Pro не является уполномоченным дистрибьютором или представителем производителя. Размещенные на этом сайте торговые марки являются собственностью их соответствующих владельцев</p>
    @if($contact->is_active)
        <p class="info">Наша почта - <a href="{{ $contact->email }}">{{ $contact->email }}</a></p>
    <p class="info">Телефон <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
    @endif
    <div class="footer-social-container">
        <div class="left">
            <a href="{{ route('police') }}" class="social-link">Политика конфиденциальности</a>
            <a href="{{ route('agreement') }}" class="social-link">Согласие на обработку персональных данных</a>
        </div>
        <div>
            {{--            <a href="#" class="social-link">instagram</a>--}}
            {{--            <a href="#" class="social-link">facebook</a>--}}
            {{--            <a href="#" class="social-link">twitter</a>--}}
        </div>
    </div>
    <p class="footer-credit">© 2024 PLC_Pro-100</p>
</footer>
