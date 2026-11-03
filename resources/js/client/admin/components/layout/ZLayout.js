import React, { useEffect, useState } from 'react';
import ProLayout from '@ant-design/pro-layout';
import { useHistory, useLocation } from 'react-router-dom';
import { useSelector } from 'react-redux';
import Routes from '../../../common/helpers/Routes';
import PropTypes from 'prop-types';
import Utils from '../../../common/helpers/Utils';
import {
  HomeOutlined,
  FileTextOutlined,
  ExperimentOutlined,
  ControlOutlined,
  TeamOutlined,
  MailOutlined,
  ThunderboltOutlined,
} from '@ant-design/icons';
import { message } from 'antd';
import NavContent from './NavContent';
import { useIsMobile } from '../../../common/hooks/IsMobile';
import axios from 'axios';

const ICONS = {
    dashboard: <HomeOutlined />,
    portfolio: <ExperimentOutlined />,
    visitors: <TeamOutlined />,
    messages: <MailOutlined />,
    optimize: <ThunderboltOutlined />,
    logs: <FileTextOutlined />,
    settings: <ControlOutlined />,
};

const staticRoute = {
    routes: [
        {
            path: Routes.web.admin.dashboard,
            key: Routes.web.admin.dashboard,
            name: 'Dashboard',
            iconType: 'dashboard',
        },
        {
            path: 'portfolio',
            name: 'Portofolio',
            iconType: 'portfolio',
            routes: [
                {
                    path: Routes.web.admin.portfolioConfig,
                    key: Routes.web.admin.portfolioConfig,
                    name: 'Konfigurasi',
                },
                {
                    path: Routes.web.admin.portfolioAbout,
                    key: Routes.web.admin.portfolioAbout,
                    name: 'Tentang',
                },
                {
                    path: Routes.web.admin.portfolioSkills,
                    key: Routes.web.admin.portfolioSkills,
                    name: 'Keahlian',
                },
                {
                    path: Routes.web.admin.portfolioEducation,
                    key: Routes.web.admin.portfolioEducation,
                    name: 'Pendidikan',
                },
                {
                    path: Routes.web.admin.portfolioExperiences,
                    key: Routes.web.admin.portfolioExperiences,
                    name: 'Pengalaman',
                },
                {
                    path: Routes.web.admin.portfolioProjects,
                    key: Routes.web.admin.portfolioProjects,
                    name: 'Proyek',
                },
                {
                    path: Routes.web.admin.portfolioServices,
                    key: Routes.web.admin.portfolioServices,
                    name: 'Layanan',
                },
            ],
        },
        {
            path: Routes.web.admin.visitors,
            key: Routes.web.admin.visitors,
            name: 'Pengunjung',
            iconType: 'visitors',
        },
        {
            path: Routes.web.admin.messages,
            key: Routes.web.admin.messages,
            name: 'Pesan',
            iconType: 'messages',
        },
        {
            path: Routes.web.frontend.optimize,
            key: Routes.web.frontend.optimize,
            name: 'Optimalkan',
            iconType: 'optimize',
        },
        {
            path: Routes.web.admin.systemLogs,
            key: Routes.web.admin.systemLogs,
            name: 'Log Sistem',
            iconType: 'logs',
        },
        {
            path: Routes.web.admin.settings,
            key: Routes.web.admin.settings,
            name: 'Pengaturan',
            iconType: 'settings',
        },
    ]
};

const ZLayout = ({ children }) => {
    const isMobile = useIsMobile();
    const location = useLocation();
    const globalState = useSelector(state => state.globalState);
    const logo = globalState.logo;
    const siteName = globalState.siteName;
    const menuColor = globalState.menuColor;
    const navColor = globalState.navColor;
    const layout = globalState.menuLayout;
    const [collapsed, setCollapsed] = useState(false);
    let history = useHistory();

    useEffect(() => {
        !isMobile && setCollapsed(globalState.shortMenu);
    }, [globalState.shortMenu])

    const optimizeOnClick = () => {
        message.loading({
            content: 'Sedang memproses..',
            duration: 0,
            key: 'optimize'
        });

        axios.get(Routes.web.frontend.optimize, {
            headers: { 
                Accept: 'application/json'
            }
        })
        .then(response => {
            Utils.handleSuccessResponse(response, () => {
                message.success({ 
                    content: response.data.message, 
                    key: 'optimize'
                });
            })
        })
        .catch((error) => {
            Utils.handleException(error);
        });
    }

    const navigateToPath = (path) => {
        history.push(path);
    }
    
    return (
        <React.Fragment>
            <div
                style={{
                    height: '100vh',
                }}
            >
                <ProLayout
                    title={siteName}
                    navTheme={menuColor}
                    headerTheme={navColor}
                    layout={!isMobile ? layout : 'mix'}
                    fixedHeader={true}
                    collapsed={collapsed}
                    onCollapse={(_collapsed) => setCollapsed(_collapsed)}
                    logo={`${Utils.backend}/${logo}`}
                    route={staticRoute}
                    location={{ pathname: location.pathname }}
                    fixSiderbar
                    onMenuHeaderClick={() => navigateToPath(Routes.web.admin.dashboard)}
                    subMenuItemRender={(item) => (
                        <span>
                            {item.iconType && ICONS[item.iconType]}
                            <span style={{ marginLeft: item.iconType ? 10 : 0 }}>{item.name}</span>
                        </span>
                    )}
                    menuItemRender={(item) => (
                        <a
                            onClick={(e) => {
                                e.preventDefault();

                                if (item.path === Routes.web.frontend.optimize) {
                                    optimizeOnClick();
                                } else if (item.path === Routes.web.admin.systemLogs) {
                                    window.open(Routes.web.admin.systemLogs);
                                } else {
                                    navigateToPath(item.path);
                                }
                            }}
                            href={item.path}
                        >
                            {item.iconType && ICONS[item.iconType]}
                            <span style={{ marginLeft: item.iconType ? 10 : 0 }}>{item.name}</span>
                        </a>
                    )}
                    rightContentRender={() => <NavContent/>}
                    breadcrumbRender={() => ('')}
                >
                    {children}
                </ProLayout>
            </div>
        </React.Fragment>
    )
}

ZLayout.propTypes = {
    children: PropTypes.node,
}

export default React.memo(ZLayout);
