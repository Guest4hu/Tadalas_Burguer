            <!-- End of page content -->
        </div>
    </main>

    <!-- Footer -->
    <footer style="
        margin-left: var(--sidebar-width);
        background: linear-gradient(135deg, #1a1a1a 0%, #2a1515 100%);
        border-top: 2px solid var(--accent-red);
        padding: 2rem;
        position: relative;
        z-index: 1;
    ">
        <div style="
            max-width: 1400px;
            margin: 0 auto;
        ">
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                margin-bottom: 2rem;
            ">
                <!-- Sobre -->
                <div>
                    <h3 style="
                        font-size: 1.125rem;
                        font-weight: 700;
                        margin-bottom: 1rem;
                        color: var(--accent-red);
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="fa-solid fa-burger"></i>
                        Tadallas Burguer
                    </h3>
                    <p style="
                        color: var(--text-secondary);
                        font-size: 0.9375rem;
                        line-height: 1.6;
                    ">
                        Sistema de gerenciamento completo para hamburguerias. 
                        Controle pedidos, estoque, funcionários e muito mais.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div>
                    <h3 style="
                        font-size: 1.125rem;
                        font-weight: 700;
                        margin-bottom: 1rem;
                        color: var(--accent-red);
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="fa-solid fa-link"></i>
                        Links Rápidos
                    </h3>
                    <ul style="
                        list-style: none;
                        padding: 0;
                        margin: 0;
                    ">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="/backend/cliente" style="
                                color: var(--text-secondary);
                                text-decoration: none;
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                                transition: color 0.3s ease;
                                font-size: 0.9375rem;
                            " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-secondary)'">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i>
                                Clientes
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="/backend/pedidos" style="
                                color: var(--text-secondary);
                                text-decoration: none;
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                                transition: color 0.3s ease;
                                font-size: 0.9375rem;
                            " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-secondary)'">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i>
                                Pedidos
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="/backend/produtos" style="
                                color: var(--text-secondary);
                                text-decoration: none;
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                                transition: color 0.3s ease;
                                font-size: 0.9375rem;
                            " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-secondary)'">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i>
                                Produtos
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="/backend/configuracao" style="
                                color: var(--text-secondary);
                                text-decoration: none;
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                                transition: color 0.3s ease;
                                font-size: 0.9375rem;
                            " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-secondary)'">
                                <i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i>
                                Configurações
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contato -->
                <div>
                    <h3 style="
                        font-size: 1.125rem;
                        font-weight: 700;
                        margin-bottom: 1rem;
                        color: var(--accent-red);
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    ">
                        <i class="fa-solid fa-headset"></i>
                        Suporte
                    </h3>
                    <ul style="
                        list-style: none;
                        padding: 0;
                        margin: 0;
                    ">
                        <li style="
                            margin-bottom: 0.75rem;
                            color: var(--text-secondary);
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            font-size: 0.9375rem;
                        ">
                            <i class="fa-solid fa-envelope"></i>
                            suporte@tadallas.com
                        </li>
                        <li style="
                            margin-bottom: 0.75rem;
                            color: var(--text-secondary);
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            font-size: 0.9375rem;
                        ">
                            <i class="fa-solid fa-phone"></i>
                            (11) 9999-9999
                        </li>
                        <li style="
                            margin-bottom: 0.75rem;
                            color: var(--text-secondary);
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            font-size: 0.9375rem;
                        ">
                            <i class="fa-solid fa-clock"></i>
                            Seg-Sex: 9h às 18h
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div style="
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--border-color), transparent);
                margin: 2rem 0;
            "></div>

            <!-- Copyright -->
            <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            ">
                <p style="
                    color: var(--text-muted);
                    font-size: 0.875rem;
                    margin: 0;
                ">
                    &copy; <?= date('Y') ?> Tadallas Burguer. Todos os direitos reservados.
                </p>
                <div style="
                    display: flex;
                    gap: 1rem;
                ">
                    <a href="#" style="
                        color: var(--text-muted);
                        font-size: 1.25rem;
                        transition: color 0.3s ease;
                    " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-muted)'" title="Facebook">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="#" style="
                        color: var(--text-muted);
                        font-size: 1.25rem;
                        transition: color 0.3s ease;
                    " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-muted)'" title="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" style="
                        color: var(--text-muted);
                        font-size: 1.25rem;
                        transition: color 0.3s ease;
                    " onmouseover="this.style.color='var(--accent-red)'" onmouseout="this.style.color='var(--text-muted)'" title="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        @media (max-width: 992px) {
            footer {
                margin-left: 0 !important;
            }
        }
    </style>

</body>
</html>